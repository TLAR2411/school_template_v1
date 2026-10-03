<?php

namespace App\Services\School;

use App\Models\School\Classes;
use App\Models\School\ScoreEntry;
use App\Models\School\StudentClass;
use App\Models\School\Subject;
use App\Models\School\Teacher;
use App\Models\School\TeacherClass;
use Illuminate\Support\Collection;

/**
 * Tracks which class + subject (teacher) still need monthly scores.
 */
class ScoreEntryStatusService
{
    /**
     * @return array{rows: array<int, array>, summary: array{missing: int, partial: int, done: int, total: int}}
     */
    public function list(
        int $monthId,
        ?int $yearId,
        ?int $curId,
        ?int $branchId,
        ?int $gradeId = null,
        ?int $classId = null,
        ?string $status = null
    ): array {
        $classes = Classes::query()
            ->where('is_active', true)
            ->when($yearId, fn ($q) => $q->whereYear($yearId))
            ->when($branchId, fn ($q) => $q->whereBranch($branchId))
            ->when($curId, fn ($q) => $q->whereCurriculum($curId))
            ->when($gradeId, fn ($q) => $q->where('grade_id', $gradeId))
            ->when($classId, fn ($q) => $q->where('id', $classId))
            ->with(['grade:id,name_en,name_kh,cur_id'])
            ->orderBy('grade_id')
            ->orderBy('id')
            ->get(['id', 'name_en', 'name_kh', 'grade_id', 'class_type_id', 'year_id', 'branch_id']);

        if ($classes->isEmpty()) {
            return [
                'rows'    => [],
                'summary' => ['missing' => 0, 'partial' => 0, 'done' => 0, 'total' => 0],
            ];
        }

        $classIds = $classes->pluck('id')->all();

        $studentCounts = StudentClass::query()
            ->whereIn('class_id', $classIds)
            ->where('is_active', true)
            ->where('is_transfer_class', false)
            ->selectRaw('class_id, count(*) as total')
            ->groupBy('class_id')
            ->pluck('total', 'class_id');

        $scoreCounts = ScoreEntry::query()
            ->whereIn('class_id', $classIds)
            ->where('month_id', $monthId)
            ->when($yearId, fn ($q) => $q->where('year_id', $yearId))
            ->whereNotNull('score')
            ->selectRaw('class_id, subject_id, count(distinct student_id) as scored')
            ->groupBy('class_id', 'subject_id')
            ->get()
            ->keyBy(fn ($r) => (int) $r->class_id . '_' . (int) $r->subject_id);

        $teacherRows = TeacherClass::query()
            ->whereIn('class_id', $classIds)
            ->where(function ($q) {
                $q->where('is_active', true)->orWhereNull('is_active');
            })
            ->with(['teacher:id,name_en,name_kh', 'subject:id,parent_id,name_en,name_kh'])
            ->get();

        $teachersByClassSubject = [];
        foreach ($teacherRows as $row) {
            $cid = (int) $row->class_id;
            $sid = (int) $row->subject_id;
            $teachersByClassSubject[$cid][$sid] = $row->teacher;
            if ($row->subject?->parent_id) {
                // child assignment also covers itself
            }
        }

        $subjectsByGradeType = $this->loadScoreColumnsByGrade($classes, $yearId, $curId);

        $rows = [];
        $summary = ['missing' => 0, 'partial' => 0, 'done' => 0, 'total' => 0];

        foreach ($classes as $class) {
            $cid = (int) $class->id;
            $totalStudents = (int) ($studentCounts[$cid] ?? 0);
            $key = $class->grade_id . '_' . ($class->class_type_id ?? 'null');
            $columns = $subjectsByGradeType[$key] ?? $subjectsByGradeType[$class->grade_id . '_null'] ?? [];

            foreach ($columns as $col) {
                $sid = (int) $col['id'];
                $scored = (int) ($scoreCounts->get($cid . '_' . $sid)?->scored ?? 0);
                $rowStatus = $this->resolveStatus($scored, $totalStudents);
                $summary[$rowStatus] = ($summary[$rowStatus] ?? 0) + 1;
                $summary['total']++;

                if ($status && $status !== 'all' && $rowStatus !== $status) {
                    continue;
                }

                $teacher = $this->resolveTeacher($teachersByClassSubject[$cid] ?? [], $sid, $col['parent_id'] ?? null);

                $rows[] = [
                    'class_id'         => $cid,
                    'class_name_en'    => $class->name_en,
                    'class_name_kh'    => $class->name_kh,
                    'grade_id'         => $class->grade_id,
                    'grade_name_en'    => $class->grade?->name_en,
                    'grade_name_kh'    => $class->grade?->name_kh,
                    'subject_id'       => $sid,
                    'subject_name_en'  => $col['name_en'],
                    'subject_name_kh'  => $col['name_kh'],
                    'parent_subject_id'=> $col['parent_id'],
                    'teacher_id'       => $teacher?->id,
                    'teacher_name_en'  => $teacher?->name_en,
                    'teacher_name_kh'  => $teacher?->name_kh,
                    'total_students'   => $totalStudents,
                    'scored_students'  => $scored,
                    'status'           => $rowStatus,
                ];
            }
        }

        $this->attachTelegramConnected($rows);

        return ['rows' => $rows, 'summary' => $summary];
    }

    /**
     * @param  array<int, array<string, mixed>>  $rows
     */
    private function attachTelegramConnected(array &$rows): void
    {
        $teacherIds = collect($rows)
            ->pluck('teacher_id')
            ->filter()
            ->unique()
            ->values()
            ->all();

        if ($teacherIds === []) {
            return;
        }

        $connectedByTeacher = Teacher::query()
            ->whereIn('id', $teacherIds)
            ->withTelegramStatus()
            ->pluck('telegram_connected', 'id');

        foreach ($rows as &$row) {
            $teacherId = $row['teacher_id'] ?? null;
            $row['telegram_connected'] = $teacherId
                ? (bool) ($connectedByTeacher[$teacherId] ?? false)
                : false;
        }
        unset($row);
    }

    private function resolveStatus(int $scored, int $total): string
    {
        if ($total <= 0) {
            return $scored > 0 ? 'done' : 'missing';
        }
        if ($scored <= 0) {
            return 'missing';
        }
        if ($scored < $total) {
            return 'partial';
        }

        return 'done';
    }

    private function resolveTeacher(array $bySubject, int $subjectId, ?int $parentId)
    {
        if (!empty($bySubject[$subjectId])) {
            return $bySubject[$subjectId];
        }
        if ($parentId && !empty($bySubject[$parentId])) {
            return $bySubject[$parentId];
        }

        return null;
    }

    /**
     * Score columns grouped by grade_id + class_type_id (same idea as ScoreEntryController).
     *
     * @param  Collection<int, Classes>  $classes
     * @return array<string, array<int, array{id:int,parent_id:?int,name_en:?string,name_kh:?string}>>
     */
    private function loadScoreColumnsByGrade(Collection $classes, ?int $yearId, ?int $curId): array
    {
        $parents = Subject::query()
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->when($curId, fn ($q) => $q->whereCurriculum($curId))
            ->with([
                'gradingRules' => function ($q) use ($yearId) {
                    $q->when($yearId, function ($q) use ($yearId) {
                        $q->where(fn ($q) => $q->where('year_id', $yearId)->orWhereNull('year_id'));
                    })->orderBy('id');
                },
                'children' => function ($q) use ($yearId) {
                    $q->where('is_active', true)
                        ->orderBy('id')
                        ->with(['gradingRules' => function ($q) use ($yearId) {
                            $q->when($yearId, function ($q) use ($yearId) {
                                $q->where(fn ($q) => $q->where('year_id', $yearId)->orWhereNull('year_id'));
                            })->orderBy('id');
                        }]);
                },
            ])
            ->orderBy('id')
            ->get();

        $result = [];
        $combos = $classes->map(fn ($c) => [
            'grade_id'      => (int) $c->grade_id,
            'class_type_id' => $c->class_type_id ? (int) $c->class_type_id : null,
        ])->unique(fn ($c) => $c['grade_id'] . '_' . ($c['class_type_id'] ?? 'null'));

        foreach ($combos as $combo) {
            $gradeId = $combo['grade_id'];
            $classTypeId = $combo['class_type_id'];
            $key = $gradeId . '_' . ($classTypeId ?? 'null');
            $columns = [];

            foreach ($parents as $subject) {
                $childCols = [];
                foreach ($subject->children as $child) {
                    $rule = $this->pickRule($child->gradingRules, $gradeId, $classTypeId);
                    if ($rule) {
                        $childCols[] = [
                            'id'        => (int) $child->id,
                            'parent_id' => (int) $subject->id,
                            'name_en'   => $child->name_en,
                            'name_kh'   => $child->name_kh,
                        ];
                    }
                }

                if (!empty($childCols)) {
                    array_push($columns, ...$childCols);
                    continue;
                }

                $rule = $this->pickRule($subject->gradingRules, $gradeId, $classTypeId);
                if ($rule) {
                    $columns[] = [
                        'id'        => (int) $subject->id,
                        'parent_id' => null,
                        'name_en'   => $subject->name_en,
                        'name_kh'   => $subject->name_kh,
                    ];
                }
            }

            $result[$key] = $columns;
        }

        return $result;
    }

    private function pickRule(Collection $rules, int $gradeId, ?int $classTypeId)
    {
        $forGrade = $rules->where('grade_id', $gradeId);
        if ($forGrade->isEmpty()) {
            return null;
        }

        if ($classTypeId) {
            $exact = $forGrade->firstWhere('class_type_id', $classTypeId);
            if ($exact) {
                return $exact;
            }
        }

        return $forGrade->first(fn ($r) => $r->class_type_id === null) ?? $forGrade->first();
    }
}
