<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\School\Grade;
use App\Models\School\TermPeriod;
use App\Models\School\TermPeriodList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TermPeriodListController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'term_period_id' => 'required|integer|exists:term_periods,id',
            'edu_id' => 'required|integer|exists:education_levels,id',
            'study_months' => 'required|array|min:1',
            'study_months.*' => 'integer|exists:months,id',
            'exam_month' => 'required|integer|exists:months,id',
        ]);

        if (in_array($data['exam_month'], $data['study_months'], true)) {
            throw ValidationException::withMessages([
                'exam_month' => ['Exam month cannot be in study months'],
            ]);
        }

        $term = TermPeriod::findOrFail($data['term_period_id']);
        $grades = Grade::query()
            ->where('edu_id', $data['edu_id'])
            ->where('cur_id', $term->cur_id)
            ->pluck('id');

        if ($grades->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No grades found for this education level',
            ], 422);
        }

        try {
            DB::transaction(function () use ($data, $term, $grades) {
                TermPeriodList::where('term_period_id', $term->id)
                    ->whereIn('grade_id', $grades)
                    ->delete();

                $this->insertRowsForGrade($term, $data, $grades->all());
            });

            return response()->json([
                'status' => true,
                'message' => 'Term period list created successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'term_period_id' => 'required|integer|exists:term_periods,id',
            'grade_id' => 'required|integer|exists:grades,id',
            'study_months' => 'required|array|min:1',
            'study_months.*' => 'integer|exists:months,id',
            'exam_month' => 'required|integer|exists:months,id',
        ]);

        if (in_array($data['exam_month'], $data['study_months'], true)) {
            throw ValidationException::withMessages([
                'exam_month' => ['Exam month cannot be in study months'],
            ]);
        }

        $term = TermPeriod::findOrFail($data['term_period_id']);

        try {
            DB::transaction(function () use ($data, $term) {
                TermPeriodList::where('term_period_id', $term->id)
                    ->where('grade_id', $data['grade_id'])
                    ->delete();

                $this->insertRowsForGrade($term, $data, [$data['grade_id']]);
            });

            return response()->json([
                'status' => true,
                'message' => 'Term period list updated successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    private function insertRowsForGrade(TermPeriod $term, array $data, array $gradeIds): void
    {
        $userId = auth('api')->id();
        $rows = [];

        foreach ($gradeIds as $gradeId) {
            foreach ($data['study_months'] as $monthId) {
                $rows[] = [
                    'term_period_id' => $term->id,
                    'grade_id' => $gradeId,
                    'month_id' => $monthId,
                    'role' => 'study',
                    'year_id' => $term->year_id,
                    'cur_id' => $term->cur_id,
                    'branch_id' => $term->branch_id,
                    'semester_month_id' => $data['exam_month'],
                    'created_by' => $userId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            $rows[] = [
                'term_period_id' => $term->id,
                'grade_id' => $gradeId,
                'month_id' => $data['exam_month'],
                'role' => 'exam',
                'year_id' => $term->year_id,
                'cur_id' => $term->cur_id,
                'branch_id' => $term->branch_id,
                'semester_month_id' => $data['exam_month'],
                'created_by' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (!empty($rows)) {
            TermPeriodList::insert($rows);
        }
    }
}
