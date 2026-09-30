<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\School\Classes;
use App\Models\School\ScoreEntry;
use App\Models\School\ScoreMonthHeader;
use App\Models\School\StudentClass;
use App\Models\School\Subject;
use App\Models\School\Teacher;
use App\Models\School\TeacherClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScoreEntryController extends Controller
{
    /** Load sheet: subjects + students. Empty scores → blank cells. */
    public function getScoreData(Request $request)
    {
        $data = $request->validate([
            'class_id'   => 'required|integer|exists:classes,id',
            'month_id'   => 'required|integer|exists:months,id',
            'subject_id' => 'nullable|integer|exists:subjects,id', // English only
        ]);

        try {
            $classId   = (int) $data['class_id'];
            $monthId   = (int) $data['month_id'];
            $subjectId = isset($data['subject_id']) ? (int) $data['subject_id'] : null;
            $yearId    = $this->resolveYearId();
            $curId     = $this->resolveCurId();

            $class = Classes::findOrFail($classId);

            // 1) Header columns (grading_rules). Teacher → only subjects they teach.
            $subjects = $this->getSubjects($class, $subjectId);
            $columnIds = $this->scoreColumnIds($subjects);

            // 2) Rows always from student_class
            $enrolled = StudentClass::query()
                ->where('class_id', $classId)
                ->where('is_active', true)
                ->where('is_transfer_class', false)
                ->with('student:id,name_en,name_kh,gender,photo_path')
                ->orderBy('sort')
                ->get();

            // 3) Saved numbers for this class + month (+ year when set).
            // Do NOT filter by columnIds — merge by subject / grading_rule below.
            $scoreRows = ScoreEntry::query()
                ->where('class_id', $classId)
                ->where('month_id', $monthId)
                ->when($yearId, fn ($q) => $q->where('year_id', $yearId))
                ->get();

            $savedBySubject = $scoreRows->keyBy(
                fn ($row) => (int) $row->student_id . '_' . (int) $row->subject_id
            );
            $savedByRule = $scoreRows
                ->filter(fn ($row) => $row->grading_rule_id !== null)
                ->keyBy(
                    fn ($row) => (int) $row->student_id . '_' . (int) $row->grading_rule_id
                );

            $header = ScoreMonthHeader::query()
                ->where('class_id', $classId)
                ->where('month_id', $monthId)
                ->when($yearId, fn ($q) => $q->where('year_id', $yearId), fn ($q) => $q->whereNull('year_id'))
                ->when($curId, fn ($q) => $q->where('cur_id', $curId), fn ($q) => $q->whereNull('cur_id'))
                ->first();

            $students = $enrolled->map(function ($row) use ($columnIds, $subjects, $savedBySubject, $savedByRule) {
                $studentId = (int) $row->student_id;
                $bySubject = [];

                foreach ($columnIds as $sid) {
                    $sid = (int) $sid;
                    $info = $this->columnInfo($subjects, $sid);

                    // Prefer subject_id match; fallback grading_rule_id (same cell rule).
                    $cell = $savedBySubject->get($studentId . '_' . $sid);
                    if (!$cell && !empty($info['grading_rule_id'])) {
                        $cell = $savedByRule->get($studentId . '_' . (int) $info['grading_rule_id']);
                    }

                    $bySubject[$sid] = [
                        'score_id'        => $cell?->id,
                        'score'           => $cell?->score,
                        'is_approved'     => (bool) ($cell?->is_approved ?? false),
                        'max_score'       => $info['max_score'],
                        'grading_rule_id' => $cell?->grading_rule_id ?? $info['grading_rule_id'],
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
                    'by_subject' => $bySubject,
                ];
            })->values();

            return response()->json([
                'status' => true,
                'data'   => [
                    'class_id' => $classId,
                    'month_id' => $monthId,
                    'year_id'  => $yearId,
                    'cur_id'   => $curId,
                    'divisor'  => $header?->divisor,
                    'subjects' => $subjects,
                    'students' => $students,
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
     * Save score sheet (same idea as attendance-store).
     * Each row = one cell: student + subject + month.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'class_id' => 'required|integer|exists:classes,id',
            'month_id' => 'required|integer|exists:months,id',
            'rows'     => 'required|array|min:1',
            'rows.*.student_id'      => 'required|integer|exists:students,id',
            'rows.*.subject_id'      => 'required|integer|exists:subjects,id',
            'rows.*.score_id'        => 'nullable|integer|exists:scores,id',
            'rows.*.score'           => 'nullable|numeric',
            'rows.*.grading_rule_id' => 'nullable|integer',
            'rows.*.is_approved'     => 'nullable|boolean',
        ]);

        $classId   = (int) $data['class_id'];
        $monthId   = (int) $data['month_id'];
        $yearId    = $this->resolveYearId();
        $curId     = $this->resolveCurId();
        $branchId  = $this->resolveBranchId();
        $userId    = auth('api')->id();
        $teacherId = Teacher::query()->where('user_id', $userId)->value('id');

        // Only students enrolled in this class
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
                $subjectId = (int) $row['subject_id'];

                if (!isset($allowedStudents[$studentId])) {
                    continue;
                }

                // Skip empty cells
                if ($row['score'] === null || $row['score'] === '') {
                    continue;
                }

                $values = [
                    'score'           => (float) $row['score'],
                    'grading_rule_id' => $row['grading_rule_id'] ?? null,
                    'is_approved'     => (bool) ($row['is_approved'] ?? false),
                    'teacher_id'      => $teacherId,
                    'updated_by'      => $userId,
                    'branch_id'       => $branchId,
                    'cur_id'          => $curId,
                    'year_id'         => $yearId,
                ];

                // 1) Prefer score_id when it still matches this cell
                if (!empty($row['score_id'])) {
                    $found = ScoreEntry::query()
                        ->where('id', (int) $row['score_id'])
                        ->where('student_id', $studentId)
                        ->where('class_id', $classId)
                        ->where('subject_id', $subjectId)
                        ->where('month_id', $monthId)
                        ->first();

                    if ($found) {
                        $found->update($values);
                        continue;
                    }
                }

                // 2) Upsert by natural key (student + class + subject + month + year)
                $existingQuery = ScoreEntry::query()
                    ->where('student_id', $studentId)
                    ->where('class_id', $classId)
                    ->where('subject_id', $subjectId)
                    ->where('month_id', $monthId)
                    ->when(
                        $yearId,
                        fn ($q) => $q->where('year_id', $yearId),
                        fn ($q) => $q->whereNull('year_id')
                    );

                if (!empty($row['grading_rule_id'])) {
                    $existingQuery->where('grading_rule_id', (int) $row['grading_rule_id']);
                } else {
                    $existingQuery->whereNull('grading_rule_id');
                }

                $existing = $existingQuery->whereNull('assessment_id')->first();

                if ($existing) {
                    $existing->update($values);
                } else {
                    ScoreEntry::create([
                        'student_id'    => $studentId,
                        'class_id'      => $classId,
                        'subject_id'    => $subjectId,
                        'month_id'      => $monthId,
                        'assessment_id' => null,
                        'created_by'    => $userId,
                        ...$values,
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Score saved successfully',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /** Upsert Khmer monthly avg divisor for class + month. */
    public function saveMonthHeader(Request $request)
    {
        $data = $request->validate([
            'class_id' => 'required|integer|exists:classes,id',
            'month_id' => 'required|integer|exists:months,id',
            'divisor'  => 'nullable|numeric|min:0',
        ]);

        try {
            $classId = (int) $data['class_id'];
            $monthId = (int) $data['month_id'];
            $yearId  = $this->resolveYearId();
            $curId   = $this->resolveCurId();
            $userId  = auth('api')->id();
            $divisor = array_key_exists('divisor', $data) && $data['divisor'] !== null && $data['divisor'] !== ''
                ? (float) $data['divisor']
                : null;

            $header = ScoreMonthHeader::query()
                ->where('class_id', $classId)
                ->where('month_id', $monthId)
                ->when($yearId, fn ($q) => $q->where('year_id', $yearId), fn ($q) => $q->whereNull('year_id'))
                ->when($curId, fn ($q) => $q->where('cur_id', $curId), fn ($q) => $q->whereNull('cur_id'))
                ->first();

            if ($header) {
                $header->update([
                    'divisor'    => $divisor,
                    'updated_by' => $userId,
                ]);
            } else {
                $header = ScoreMonthHeader::create([
                    'class_id'   => $classId,
                    'month_id'   => $monthId,
                    'year_id'    => $yearId,
                    'cur_id'     => $curId,
                    'divisor'    => $divisor,
                    'created_by' => $userId,
                    'updated_by' => $userId,
                ]);
            }

            return response()->json([
                'status'  => true,
                'message' => 'Divisor saved',
                'data'    => [
                    'id'       => $header->id,
                    'class_id' => $header->class_id,
                    'month_id' => $header->month_id,
                    'year_id'  => $header->year_id,
                    'cur_id'   => $header->cur_id,
                    'divisor'  => $header->divisor,
                ],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /** Parent + children for the table header. */
    private function getSubjects($class, ?int $subjectId)
    {
        $gradeId     = $class->grade_id;
        $yearId      = $this->resolveYearId();
        $classTypeId = $class->class_type_id;

        $onlyRulesForThisClass = function ($q) use ($gradeId, $yearId, $classTypeId) {
            $q->where('grade_id', $gradeId)
                ->when($yearId, function ($q) use ($yearId) {
                    $q->where(fn ($q) => $q->where('year_id', $yearId)->orWhereNull('year_id'));
                })
                ->when(
                    $classTypeId,
                    fn ($q) => $q->where(fn ($q) => $q->where('class_type_id', $classTypeId)->orWhereNull('class_type_id')),
                    fn ($q) => $q->whereNull('class_type_id')
                )
                ->orderBy('id');
        };

        $query = Subject::query()
            ->whereNull('parent_id')
            ->whereCurriculum($this->resolveCurId() ?? $this->getCur())
            ->with([
                'gradingRules' => $onlyRulesForThisClass,
                'children' => function ($q) use ($onlyRulesForThisClass) {
                    $q->select('id', 'parent_id', 'name_en', 'name_kh', 'symbol')
                        ->with(['gradingRules' => $onlyRulesForThisClass])
                        ->orderBy('id');
                },
            ])
            ->select('id', 'parent_id', 'name_en', 'name_kh', 'symbol')
            ->orderBy('id');

        if ($subjectId) {
            $query->where('id', $subjectId); // English: one parent
        }

        $subjects = $query->get()
            ->map(fn ($s) => $this->mapSubject($s))
            ->filter(fn ($s) => $s['has_grading'] || collect($s['children'])->isNotEmpty())
            ->values();

        return $this->filterTeacherSubjects($subjects, $class->id);
    }

    /** One subject → JSON for the page. */
    private function mapSubject($subject)
    {
        $rule = $subject->gradingRules->first();

        return [
            'id'              => $subject->id,
            'name_en'         => $subject->name_en,
            'name_kh'         => $subject->name_kh,
            'parent_id'       => $subject->parent_id,
            'has_grading'     => $subject->gradingRules->isNotEmpty(),
            'max_score'       => $rule?->max_score,
            'grading_rule_id' => $rule?->id,
            'children'        => $subject->relationLoaded('children')
                ? $subject->children
                    ->map(fn ($c) => $this->mapSubject($c))
                    ->filter(fn ($c) => $c['has_grading'])
                    ->values()
                    ->all()
                : [],
        ];
    }

    /** Admin: all subjects. Teacher: only assigned in teacher_class. */
    private function filterTeacherSubjects($subjects, int $classId)
    {
        $teacherId = Teacher::query()
            ->where('user_id', auth('api')->id())
            ->value('id');

        if (!$teacherId) {
            return $subjects;
        }

        $allowed = TeacherClass::query()
            ->where('class_id', $classId)
            ->where('teacher_id', $teacherId)
            ->pluck('subject_id');

        return collect($subjects)->map(function ($subject) use ($allowed) {
            $children = collect($subject['children'] ?? [])
                ->filter(fn ($c) => $allowed->contains($c['id']))
                ->values()
                ->all();

            if (!$allowed->contains($subject['id']) && empty($children)) {
                return null;
            }

            $subject['children'] = $children;
            return $subject;
        })->filter()->values();
    }

    /** IDs you type into: child if parent has children, else parent (Math). */
    private function scoreColumnIds($subjects): array
    {
        $ids = [];
        foreach ($subjects as $subject) {
            $children = collect($subject['children'] ?? []);
            if ($children->isNotEmpty()) {
                foreach ($children as $child) {
                    $ids[] = $child['id'];
                }
            } else {
                $ids[] = $subject['id'];
            }
        }
        return $ids;
    }

    /** max_score + rule for one column (used when scores table has no row yet). */
    private function columnInfo($subjects, int $subjectId): array
    {
        foreach ($subjects as $subject) {
            if ((int) $subject['id'] === $subjectId) {
                return [
                    'max_score'       => $subject['max_score'],
                    'grading_rule_id' => $subject['grading_rule_id'],
                ];
            }
            foreach ($subject['children'] as $child) {
                if ((int) $child['id'] === $subjectId) {
                    return [
                        'max_score'       => $child['max_score'],
                        'grading_rule_id' => $child['grading_rule_id'],
                    ];
                }
            }
        }

        return ['max_score' => null, 'grading_rule_id' => null];
    }

    /** Header year: real id, or null when missing / "*". */
    private function resolveYearId(): ?int
    {
        $yearId = $this->getYear();

        return ($yearId !== null && $yearId !== '' && $yearId !== '*')
            ? (int) $yearId
            : null;
    }

    /** Header curriculum: real id, or null when missing / "*". */
    private function resolveCurId(): ?int
    {
        $curId = $this->getCur();

        return ($curId !== null && $curId !== '' && $curId !== '*')
            ? (int) $curId
            : null;
    }

    /** Header branch: real id, or null when missing / "*". */
    private function resolveBranchId(): ?int
    {
        $branchId = $this->getBranch();

        return ($branchId !== null && $branchId !== '' && $branchId !== '*')
            ? (int) $branchId
            : null;
    }
}
