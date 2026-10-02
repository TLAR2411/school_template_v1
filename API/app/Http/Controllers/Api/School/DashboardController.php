<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\School\Classes;
use App\Models\School\EducationLevel;
use App\Models\School\Grade;
use App\Models\School\Student;
use App\Models\School\Teacher;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Curriculum-scoped overview for the school dashboard.
     * Headers: X-Branch-Id, X-Curriculum-id, X-Year-Id
     */
    public function summary(Request $request)
    {
        try {
            $branchId = $this->getBranch();
            $curId = $this->getCur();
            $yearId = $this->getYear();

            $studentsTotal = $this->studentQuery($branchId, $curId)->count();
            $studentsFemale = $this->studentQuery($branchId, $curId)
                ->where(function ($q) {
                    $q->whereRaw('LOWER(gender) = ?', ['female'])
                        ->orWhere('gender', 'F')
                        ->orWhere('gender', 'f');
                })
                ->count();

            $teachersTotal = $this->teacherQuery($branchId, $curId)->count();
            $teachersFemale = $this->teacherQuery($branchId, $curId)
                ->where(function ($q) {
                    $q->whereRaw('LOWER(gender) = ?', ['female'])
                        ->orWhere('gender', 'F')
                        ->orWhere('gender', 'f');
                })
                ->count();

            $classesTotal = $this->classQuery($branchId, $curId, $yearId)->count();
            $gradesTotal = $this->gradeQuery($branchId, $curId)->count();

            $educationLevels = $this->educationLevelBreakdown($branchId, $curId, $yearId);

            return response()->json([
                'status' => true,
                'data'   => [
                    'students_total'         => $studentsTotal,
                    'students_female'        => $studentsFemale,
                    'teachers_total'         => $teachersTotal,
                    'teachers_female'        => $teachersFemale,
                    'classes_total'          => $classesTotal,
                    'grades_total'           => $gradesTotal,
                    'show_education_levels'  => count($educationLevels) > 0,
                    'education_levels'       => $educationLevels,
                ],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    private function studentQuery($branchId, $curId)
    {
        return Student::query()
            ->where('is_active', true)
            ->whereBranch($branchId)
            ->whereCur($curId)
            ->whereHas('studentCurriculums', function ($q) use ($curId, $branchId) {
                $q->where('is_active', true)
                    ->whereCurriculum($curId)
                    ->whereBranch($branchId);
            });
    }

    private function teacherQuery($branchId, $curId)
    {
        return Teacher::query()
            ->where('is_active', true)
            ->whereBranch($branchId)
            ->whereCur($curId);
    }

    private function classQuery($branchId, $curId, $yearId)
    {
        return Classes::query()
            ->where('is_active', true)
            ->whereBranch($branchId)
            ->whereCurriculum($curId)
            ->whereYear($yearId);
    }

    private function gradeQuery($branchId, $curId)
    {
        return Grade::query()
            ->where('is_active', true)
            ->when($curId && $curId !== '*', fn ($q) => $q->where('cur_id', $curId))
            ->when($branchId && $branchId !== '*', fn ($q) => $q->where('branch_id', $branchId));
    }

    /**
     * Only for curricula that use education levels (e.g. Khmer).
     * English grades often have null edu_id → empty list (UI hides section).
     */
    private function educationLevelBreakdown($branchId, $curId, $yearId): array
    {
        $gradeRows = Grade::query()
            ->where('is_active', true)
            ->whereNotNull('edu_id')
            ->when($curId && $curId !== '*', fn ($q) => $q->where('cur_id', $curId))
            ->when($branchId && $branchId !== '*', fn ($q) => $q->where('branch_id', $branchId))
            ->select('id', 'edu_id')
            ->get();

        if ($gradeRows->isEmpty()) {
            return [];
        }

        $eduIds = $gradeRows->pluck('edu_id')->unique()->filter()->values();
        $levels = EducationLevel::query()
            ->whereIn('id', $eduIds)
            ->where('is_active', true)
            ->orderBy('id')
            ->get(['id', 'name_en', 'name_kh', 'symbol'])
            ->keyBy('id');

        $result = [];
        foreach ($eduIds as $eduId) {
            $level = $levels->get($eduId);
            if (!$level) {
                continue;
            }

            $gradeIds = $gradeRows->where('edu_id', $eduId)->pluck('id')->all();
            $classesCount = Classes::query()
                ->where('is_active', true)
                ->whereIn('grade_id', $gradeIds)
                ->whereBranch($branchId)
                ->whereYear($yearId)
                ->count();

            $result[] = [
                'edu_id'         => (int) $eduId,
                'name_en'        => $level->name_en,
                'name_kh'        => $level->name_kh,
                'symbol'         => $level->symbol,
                'grades_count'   => count($gradeIds),
                'classes_count'  => $classesCount,
            ];
        }

        return $result;
    }
}
