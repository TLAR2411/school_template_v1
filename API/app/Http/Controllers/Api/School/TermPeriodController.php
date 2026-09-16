<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Http\Resources\DataTableResource;
use App\Models\School\Grade;
use App\Models\School\Month;
use App\Models\School\TermPeriod;
use App\Models\School\TermPeriodList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TermPeriodController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name_en' => 'nullable|string|max:255',
            'name_kh' => 'nullable|string|max:255',
            'cur_id' => 'nullable|integer|exists:curriculums,id',
            'year_id' => 'nullable|integer|exists:years,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $branchId = $this->getBranch();
        if (!$branchId || $branchId === '*') {
            return response()->json(['status' => false, 'message' => 'Please select a branch'], 422);
        }

        $yearId = $data['year_id'] ?? $this->getYear();
        if (!$yearId || $yearId === '*') {
            return response()->json(['status' => false, 'message' => 'Please select a year'], 422);
        }

        $curId = $data['cur_id'] ?? $this->getCur();
        if (!$curId || $curId === '*') {
            return response()->json(['status' => false, 'message' => 'Please select a curriculum'], 422);
        }

        try {
            TermPeriod::create([
                'name_en' => $data['name_en'] ?? null,
                'name_kh' => $data['name_kh'] ?? null,
                'cur_id' => $curId,
                'branch_id' => $branchId,
                'year_id' => $yearId,
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'created_by' => auth('api')->id(),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Term period created successfully',
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
            'id' => 'required|integer|exists:term_periods,id',
            'name_en' => 'nullable|string|max:255',
            'name_kh' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        try {
            TermPeriod::findOrFail($data['id'])->update([
                'name_en' => $data['name_en'] ?? null,
                'name_kh' => $data['name_kh'] ?? null,
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'updated_by' => auth('api')->id(),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Term period updated successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function list(Request $request)
    {
        try {
            $yearId = $request->year_id ?? $this->getYear();
            $curId = $request->cur_id ?? $this->getCur();
            $branchId = $this->getBranch();

            $filters = array_merge($request->filter ?? [], [
                'year_id' => ($yearId && $yearId !== '*') ? $yearId : null,
                'cur_id' => ($curId && $curId !== '*') ? $curId : null,
            ]);

            $query = TermPeriod::query()
                ->filter($filters)
                ->whereBranch($branchId)
                ->withCount('lists')
                ->orderBy('start_date');

            $data = DataTableResource::collection(
                $query->paginate($request->limit ?? 15)
            )->response()->getData(true);

            return response()->json([
                'status' => true,
                'data' => $data,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function show(Request $request)
    {
        $request->validate(['id' => 'required|integer|exists:term_periods,id']);

        try {
            $term = TermPeriod::with([
                'lists' => fn ($q) => $q->orderBy('grade_id')->orderBy('month_id'),
            ])->findOrFail($request->id);

            $monthsById = Month::query()->get()->keyBy('id');

            $listsByGrade = $term->lists
                ->groupBy('grade_id')
                ->map(function ($rows, $gradeId) use ($monthsById) {
                    $grade = Grade::find($gradeId);
                    $studyMonthIds = $rows->where('role', 'study')->pluck('month_id')->values();
                    $examMonthId = $rows->where('role', 'exam')->pluck('month_id')->first();
                    $monthLabelEn = fn ($id) => $monthsById->get($id)?->name_en ?? (string) $id;
                    $monthLabelKh = fn ($id) => $monthsById->get($id)?->name_kh
                        ?? $monthsById->get($id)?->name_en
                        ?? (string) $id;

                    return [
                        'id' => (int) $gradeId,
                        'grade_id' => (int) $gradeId,
                        'grade_name_en' => $grade?->name_en,
                        'grade_name_kh' => $grade?->name_kh,
                        'grade_level' => $grade?->grade_level,
                        'study_months' => $studyMonthIds->all(),
                        'exam_month' => $examMonthId,
                        'study_months_label' => $studyMonthIds->map($monthLabelEn)->join(', '),
                        'study_months_label_kh' => $studyMonthIds->map($monthLabelKh)->join(', '),
                        'exam_month_label' => $examMonthId ? $monthLabelEn($examMonthId) : '-',
                        'exam_month_label_kh' => $examMonthId ? $monthLabelKh($examMonthId) : '-',
                    ];
                })
                ->values();

            return response()->json([
                'status' => true,
                'data' => [
                    'term_period' => $term,
                    'lists_by_grade' => $listsByGrade,
                ],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function delete(Request $request)
    {
        $request->validate(['id' => 'required|integer|exists:term_periods,id']);

        try {
            DB::transaction(function () use ($request) {
                TermPeriodList::where('term_period_id', $request->id)->delete();
                TermPeriod::findOrFail($request->id)->delete();
            });

            return response()->json([
                'status' => true,
                'message' => 'Term period deleted successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function all(Request $request)
    {
        try {
            $yearId = $request->year_id ?? $this->getYear();
            $curId = $request->cur_id ?? $this->getCur();
            $branchId = $this->getBranch();

            $data = TermPeriod::query()
                ->when($yearId && $yearId !== '*', fn ($q) => $q->where('year_id', $yearId))
                ->when($curId && $curId !== '*', fn ($q) => $q->where('cur_id', $curId))
                ->whereBranch($branchId)
                ->orderBy('start_date')
                ->get();

            return response()->json([
                'status' => true,
                'data' => $data,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

}