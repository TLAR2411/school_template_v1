<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\School\Classes;
use App\Models\School\ScoreEntry;
use App\Models\School\StudentClass;
use App\Models\School\Subject;
use App\Models\School\Teacher;
use App\Models\School\TeacherClass;
use Illuminate\Http\Request;

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
            $yearId    = $this->getYear();

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

            // 3) Saved numbers (may be empty)
            $saved = ScoreEntry::query()
                ->where('class_id', $classId)
                ->where('month_id', $monthId)
                ->when($yearId, fn($q) => $q->where('year_id', $yearId))
                ->when($columnIds, fn($q) => $q->whereIn('subject_id', $columnIds))
                ->get()
                ->keyBy(fn($row) => $row->student_id . '_' . $row->subject_id);

            $students = $enrolled->map(function ($row) use ($columnIds, $subjects, $saved) {
                $bySubject = [];
                foreach ($columnIds as $sid) {
                    $info = $this->columnInfo($subjects, $sid);
                    $cell = $saved->get($row->student_id . '_' . $sid);
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
                    'student_id' => $row->student_id,
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
                    'cur_id'   => $this->getCur(),
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

    /** Parent + children for the table header. */
    private function getSubjects($class, ?int $subjectId)
    {
        $gradeId     = $class->grade_id;
        $yearId      = $this->getYear();
        $classTypeId = $class->class_type_id;

        $onlyRulesForThisClass = function ($q) use ($gradeId, $yearId, $classTypeId) {
            $q->where('grade_id', $gradeId)
                ->when($yearId, function ($q) use ($yearId) {
                    $q->where(fn($q) => $q->where('year_id', $yearId)->orWhereNull('year_id'));
                })
                ->when(
                    $classTypeId,
                    fn($q) => $q->where(fn($q) => $q->where('class_type_id', $classTypeId)->orWhereNull('class_type_id')),
                    fn($q) => $q->whereNull('class_type_id')
                )
                ->orderBy('id');
        };

        $query = Subject::query()
            ->whereNull('parent_id')
            ->whereCurriculum($this->getCur())
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
            ->map(fn($s) => $this->mapSubject($s))
            ->filter(fn($s) => $s['has_grading'] || collect($s['children'])->isNotEmpty())
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
                ->map(fn($c) => $this->mapSubject($c))
                ->filter(fn($c) => $c['has_grading'])
                ->values()
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
            $children = collect($subject['children'])
                ->filter(fn($c) => $allowed->contains($c['id']))
                ->values();

            if (!$allowed->contains($subject['id']) && $children->isEmpty()) {
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
            if (!empty($subject['children'])) {
                foreach ($subject['children'] as $child) {
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
}
