<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\School\Classes;
use App\Models\School\GradingRule;
use App\Models\School\ScoreEntry;
use App\Models\School\StudentClass;
use App\Models\School\Subject;
use App\Models\School\Teacher;
use App\Models\School\TeacherClass;
use App\Models\School\TermPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * English score sheet (term / quarter) — separate from Khmer monthly scores.
 *
 * Flow:
 *  1) getScoreData → students from student_class + columns from grading_rules/assessments
 *  2) store        → upsert each typed cell into scores (assessment_id + term_id)
 */
class ScoreEntryEnglishController extends Controller
{
    /**
     * Load English score sheet for class + term + subject.
     *
     * POST body: class_id, term_id, subject_id (optional — without it, return subject list only)
     */
    public function getScoreData(Request $request)
    {
        $data = $request->validate([
            'class_id'   => 'required|integer|exists:classes,id',
            'term_id'    => 'required|integer|exists:term_periods,id',
            'subject_id' => 'nullable|integer|exists:subjects,id',
        ]);

        try {
            $classId   = (int) $data['class_id'];
            $termId    = (int) $data['term_id'];
            $subjectId = isset($data['subject_id']) ? (int) $data['subject_id'] : null;
            $yearId    = $this->resolveYearId();
            $curId     = $this->resolveCurId();

            $class = Classes::findOrFail($classId);
            TermPeriod::findOrFail($termId);

            // Subject dropdown (no sheet yet)
            $subjectOptions = $this->getSubjectOptions($class);

            if (!$subjectId) {
                return response()->json([
                    'status' => true,
                    'data'   => [
                        'class_id'         => $classId,
                        'term_id'          => $termId,
                        'year_id'          => $yearId,
                        'cur_id'           => $curId,
                        'subject_options'  => $subjectOptions,
                        'sections'         => [],
                        'students'         => [],
                    ],
                ]);
            }

            // Sheet columns from grading rules + assessments
            $sections = $this->buildSections($class, $subjectId, $termId, $yearId);
            $inputColumns = $this->flattenInputColumns($sections);

            // Students always from enrollment
            $enrolled = StudentClass::query()
                ->where('class_id', $classId)
                ->where('is_active', true)
                ->where('is_transfer_class', false)
                ->with('student:id,name_en,name_kh,gender,photo_path')
                ->orderBy('sort')
                ->get();

            // Saved scores for this term + subject
            $scoreRows = ScoreEntry::query()
                ->where('class_id', $classId)
                ->where('subject_id', $subjectId)
                ->where('term_id', $termId)
                ->whereNull('month_id')
                ->when($yearId, fn ($q) => $q->where('year_id', $yearId))
                ->get();

            $savedByAssessment = $scoreRows
                ->filter(fn ($r) => $r->assessment_id !== null)
                ->keyBy(fn ($r) => (int) $r->student_id . '_a_' . (int) $r->assessment_id);

            $savedByRule = $scoreRows
                ->filter(fn ($r) => $r->assessment_id === null && $r->grading_rule_id !== null)
                ->keyBy(fn ($r) => (int) $r->student_id . '_r_' . (int) $r->grading_rule_id);

            $students = $enrolled->map(function ($row) use ($inputColumns, $savedByAssessment, $savedByRule) {
                $studentId = (int) $row->student_id;
                $byCell = [];

                foreach ($inputColumns as $col) {
                    $cellKey = $col['cell_key'];
                    $cell = $col['assessment_id']
                        ? $savedByAssessment->get($studentId . '_a_' . $col['assessment_id'])
                        : $savedByRule->get($studentId . '_r_' . $col['grading_rule_id']);

                    $byCell[$cellKey] = [
                        'score_id'        => $cell?->id,
                        'score'           => $cell?->score,
                        'is_approved'     => (bool) ($cell?->is_approved ?? false),
                        'max_score'       => $col['max_score'],
                        'grading_rule_id' => $col['grading_rule_id'],
                        'assessment_id'   => $col['assessment_id'],
                    ];
                }

                $s = $row->student;

                return [
                    'student_id' => $studentId,
                    'sort'       => $row->sort,
                    'name_en'    => $s?->name_en,
                    'name_kh'    => $s?->name_kh,
                    'gender'     => $s?->gender,
                    'photo_path' => $s?->photo_path,
                    'by_cell'    => $byCell,
                ];
            })->values();

            return response()->json([
                'status' => true,
                'data'   => [
                    'class_id'        => $classId,
                    'term_id'         => $termId,
                    'subject_id'      => $subjectId,
                    'year_id'         => $yearId,
                    'cur_id'          => $curId,
                    'subject_options' => $subjectOptions,
                    'sections'        => $sections,
                    'students'        => $students,
                ],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Save English score cells.
     *
     * POST body: class_id, term_id, subject_id, rows[]
     * each row: student_id, grading_rule_id, assessment_id?, score_id?, score, is_approved?
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'class_id'   => 'required|integer|exists:classes,id',
            'term_id'    => 'required|integer|exists:term_periods,id',
            'subject_id' => 'required|integer|exists:subjects,id',
            'rows'       => 'required|array|min:1',
            'rows.*.student_id'      => 'required|integer|exists:students,id',
            'rows.*.grading_rule_id' => 'required|integer|exists:grading_rules,id',
            'rows.*.assessment_id'   => 'nullable|integer|exists:assessments,id',
            'rows.*.score_id'        => 'nullable|integer|exists:scores,id',
            'rows.*.score'           => 'nullable|numeric',
            'rows.*.is_approved'     => 'nullable|boolean',
        ]);

        $classId   = (int) $data['class_id'];
        $termId    = (int) $data['term_id'];
        $subjectId = (int) $data['subject_id'];
        $yearId    = $this->resolveYearId();
        $curId     = $this->resolveCurId();
        $branchId  = $this->resolveBranchId();
        $userId    = auth('api')->id();
        $teacherId = Teacher::query()->where('user_id', $userId)->value('id');

        $allowedStudents = StudentClass::query()
            ->where('class_id', $classId)
            ->where('is_active', true)
            ->where('is_transfer_class', false)
            ->pluck('student_id')
            ->flip()
            ->all();

        try {
            DB::beginTransaction();

            foreach ($data['rows'] as $row) {
                $studentId = (int) $row['student_id'];
                if (!isset($allowedStudents[$studentId])) {
                    continue;
                }

                if ($row['score'] === null || $row['score'] === '') {
                    continue;
                }

                $gradingRuleId = (int) $row['grading_rule_id'];
                $assessmentId  = !empty($row['assessment_id']) ? (int) $row['assessment_id'] : null;

                $values = [
                    'score'           => (float) $row['score'],
                    'grading_rule_id' => $gradingRuleId,
                    'assessment_id'   => $assessmentId,
                    'is_approved'     => (bool) ($row['is_approved'] ?? false),
                    'teacher_id'      => $teacherId,
                    'updated_by'      => $userId,
                    'branch_id'       => $branchId,
                    'cur_id'          => $curId,
                    'year_id'         => $yearId,
                    'term_id'         => $termId,
                    'month_id'        => null,
                    'subject_id'      => $subjectId,
                ];

                // Update by score_id when valid
                if (!empty($row['score_id'])) {
                    $found = ScoreEntry::query()
                        ->where('id', (int) $row['score_id'])
                        ->where('student_id', $studentId)
                        ->where('class_id', $classId)
                        ->where('subject_id', $subjectId)
                        ->where('term_id', $termId)
                        ->first();

                    if ($found) {
                        $found->update($values);
                        continue;
                    }
                }

                // Upsert by natural key
                $existingQuery = ScoreEntry::query()
                    ->where('student_id', $studentId)
                    ->where('class_id', $classId)
                    ->where('subject_id', $subjectId)
                    ->where('term_id', $termId)
                    ->whereNull('month_id')
                    ->where('grading_rule_id', $gradingRuleId)
                    ->when(
                        $yearId,
                        fn ($q) => $q->where('year_id', $yearId),
                        fn ($q) => $q->whereNull('year_id')
                    );

                if ($assessmentId) {
                    $existingQuery->where('assessment_id', $assessmentId);
                } else {
                    $existingQuery->whereNull('assessment_id');
                }

                $existing = $existingQuery->first();

                if ($existing) {
                    $existing->update($values);
                } else {
                    ScoreEntry::create([
                        'student_id' => $studentId,
                        'class_id'   => $classId,
                        'created_by' => $userId,
                        ...$values,
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'English scores saved successfully',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    // -------------------------------------------------------------------------
    // Helpers
    // -------------------------------------------------------------------------

    /** Subjects that have grading rules for this class grade (teacher-filtered). */
    private function getSubjectOptions($class)
    {
        $gradeId     = $class->grade_id;
        $yearId      = $this->resolveYearId();
        $classTypeId = $class->class_type_id;

        $subjects = Subject::query()
            ->whereNull('parent_id')
            ->whereCurriculum($this->resolveCurId() ?? $this->getCur())
            ->whereHas('gradingRules', function ($q) use ($gradeId, $yearId, $classTypeId) {
                $this->applyRuleScope($q, $gradeId, $yearId, $classTypeId);
            })
            ->select('id', 'name_en', 'name_kh', 'symbol', 'parent_id')
            ->orderBy('id')
            ->get();

        return $this->filterTeacherSubjectList($subjects, $class->id)->values();
    }

    /**
     * Build sheet sections from grading rules for one subject.
     * Each rule = one activity block (Attendance / Homework / Work / Exam…).
     */
    private function buildSections($class, int $subjectId, int $termId, ?int $yearId): array
    {
        $gradeId     = $class->grade_id;
        $classTypeId = $class->class_type_id;

        $rules = GradingRule::query()
            ->where('subject_id', $subjectId)
            ->where(function ($q) use ($gradeId, $yearId, $classTypeId, $termId) {
                $this->applyRuleScope($q, $gradeId, $yearId, $classTypeId);
                // Prefer rules for this term, also allow rules with null term_id (shared)
                $q->where(function ($q) use ($termId) {
                    $q->where('term_id', $termId)->orWhereNull('term_id');
                });
            })
            ->with([
                'activityType:id,name_en,name_kh,symbol',
                'assessments:id,ass_name,grading_rule_id,subject_id,max_score',
            ])
            ->orderBy('id')
            ->get();

        // Sort sections: ATT → H → W → P → EXAM → others
        $order = ['ATT' => 1, 'A' => 1, 'H' => 2, 'W' => 3, 'P' => 4, 'PART' => 4, 'E' => 5, 'EXAM' => 5];

        $sections = $rules->map(function ($rule) {
            $activity = $rule->activityType;
            $symbol   = strtoupper((string) ($activity?->symbol ?? ''));
            $assessments = $rule->assessments->values();

            // Input columns: each assessment, OR one cell for the whole rule
            if ($assessments->isNotEmpty()) {
                $columns = $assessments->map(fn ($a) => [
                    'cell_key'        => 'a_' . $a->id,
                    'type'            => 'input',
                    'label'           => $a->ass_name,
                    'max_score'       => $a->max_score !== null ? (float) $a->max_score : null,
                    'grading_rule_id' => $rule->id,
                    'assessment_id'   => $a->id,
                ])->all();
            } else {
                $columns = [[
                    'cell_key'        => 'r_' . $rule->id,
                    'type'            => 'input',
                    'label'           => $activity?->name_en ?: ($symbol ?: 'Score'),
                    'max_score'       => $rule->max_score !== null ? (float) $rule->max_score : null,
                    'grading_rule_id' => $rule->id,
                    'assessment_id'   => null,
                ]];
            }

            $inputsMax = collect($columns)->sum(fn ($c) => (float) ($c['max_score'] ?? 0));

            return [
                'grading_rule_id' => $rule->id,
                'symbol'          => $symbol,
                'name_en'         => $activity?->name_en,
                'name_kh'         => $activity?->name_kh,
                'percentage'      => $rule->percentage !== null ? (float) $rule->percentage : null,
                'max_score'       => $rule->max_score !== null ? (float) $rule->max_score : $inputsMax,
                'columns'         => $columns,
                // UI helpers: show Total + % after input columns
                'show_total'      => count($columns) > 1,
                'show_percent'    => $rule->percentage !== null,
            ];
        })
            ->sortBy(fn ($s) => $order[$s['symbol']] ?? 99)
            ->values()
            ->all();

        return $sections;
    }

    /** Flat list of editable cells (no Total / % — those are computed in UI). */
    private function flattenInputColumns(array $sections): array
    {
        $cols = [];
        foreach ($sections as $section) {
            foreach ($section['columns'] as $col) {
                if (($col['type'] ?? '') === 'input') {
                    $cols[] = $col;
                }
            }
        }
        return $cols;
    }

    private function applyRuleScope($query, $gradeId, ?int $yearId, $classTypeId): void
    {
        $query->where('grade_id', $gradeId)
            ->whereNull('deleted_at')
            ->when($yearId, function ($q) use ($yearId) {
                $q->where(fn ($q) => $q->where('year_id', $yearId)->orWhereNull('year_id'));
            })
            ->when(
                $classTypeId,
                fn ($q) => $q->where(fn ($q) => $q->where('class_type_id', $classTypeId)->orWhereNull('class_type_id')),
                fn ($q) => $q->whereNull('class_type_id')
            );
    }

    private function filterTeacherSubjectList($subjects, int $classId)
    {
        $teacherId = Teacher::query()
            ->where('user_id', auth('api')->id())
            ->value('id');

        if (!$teacherId) {
            return collect($subjects);
        }

        $allowed = TeacherClass::query()
            ->where('class_id', $classId)
            ->where('teacher_id', $teacherId)
            ->pluck('subject_id');

        return collect($subjects)->filter(fn ($s) => $allowed->contains($s->id));
    }

    private function resolveYearId(): ?int
    {
        $yearId = $this->getYear();

        return ($yearId !== null && $yearId !== '' && $yearId !== '*')
            ? (int) $yearId
            : null;
    }

    private function resolveCurId(): ?int
    {
        $curId = $this->getCur();

        return ($curId !== null && $curId !== '' && $curId !== '*')
            ? (int) $curId
            : null;
    }

    private function resolveBranchId(): ?int
    {
        $branchId = $this->getBranch();

        return ($branchId !== null && $branchId !== '' && $branchId !== '*')
            ? (int) $branchId
            : null;
    }
}
