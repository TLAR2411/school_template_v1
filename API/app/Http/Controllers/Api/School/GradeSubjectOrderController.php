<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\School\GradeSubjectOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Staff customize subject column order per grade.
 * All classes in that grade share the same order on score entry.
 */
class GradeSubjectOrderController extends Controller
{
    /** Load saved order for a grade (parents + children map). */
    public function show(Request $request)
    {
        $data = $request->validate([
            'grade_id' => 'required|integer|exists:grades,id',
        ]);

        $gradeId = (int) $data['grade_id'];
        $curId   = $this->resolveCurId();

        $rows = GradeSubjectOrder::query()
            ->where('grade_id', $gradeId)
            ->when(
                $curId,
                fn ($q) => $q->where('cur_id', $curId),
                fn ($q) => $q->whereNull('cur_id')
            )
            ->orderBy('sort')
            ->get(['subject_id', 'sort']);

        $subjectIds = $rows->pluck('subject_id')->map(fn ($id) => (int) $id)->values()->all();

        // Split parents vs children using subjects.parent_id
        $meta = \App\Models\School\Subject::query()
            ->whereIn('id', $subjectIds)
            ->get(['id', 'parent_id'])
            ->keyBy('id');

        $parents = [];
        $children = [];
        foreach ($subjectIds as $sid) {
            $row = $meta->get($sid);
            if (!$row) {
                continue;
            }
            if ($row->parent_id) {
                $pid = (string) $row->parent_id;
                $children[$pid] = $children[$pid] ?? [];
                $children[$pid][] = $sid;
            } else {
                $parents[] = $sid;
            }
        }

        return response()->json([
            'status' => true,
            'data'   => [
                'grade_id' => $gradeId,
                'parents'  => $parents,
                'children' => $children,
            ],
        ]);
    }

    /**
     * Replace order for a grade.
     * Body: grade_id, parents: [subjectId…], children: { parentId: [childId…] }
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'grade_id'   => 'required|integer|exists:grades,id',
            'parents'    => 'required|array',
            'parents.*'  => 'integer|exists:subjects,id',
            'children'   => 'nullable|array',
            'children.*' => 'array',
            'children.*.*' => 'integer|exists:subjects,id',
        ]);

        $gradeId = (int) $data['grade_id'];
        $curId   = $this->resolveCurId();
        $branch  = $this->getBranch();
        $branchId = ($branch && $branch !== '*') ? (int) $branch : null;
        $userId  = auth('api')->id();

        $parents  = array_values(array_map('intval', $data['parents']));
        $children = $data['children'] ?? [];

        try {
            DB::beginTransaction();

            GradeSubjectOrder::query()
                ->where('grade_id', $gradeId)
                ->when(
                    $curId,
                    fn ($q) => $q->where('cur_id', $curId),
                    fn ($q) => $q->whereNull('cur_id')
                )
                ->delete();

            $sort = 0;
            $rows = [];

            foreach ($parents as $subjectId) {
                $rows[] = [
                    'grade_id'   => $gradeId,
                    'subject_id' => $subjectId,
                    'sort'       => $sort++,
                    'cur_id'     => $curId,
                    'branch_id'  => $branchId,
                    'created_by' => $userId,
                    'updated_by' => $userId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            foreach ($children as $childIds) {
                if (!is_array($childIds)) {
                    continue;
                }
                foreach ($childIds as $subjectId) {
                    $rows[] = [
                        'grade_id'   => $gradeId,
                        'subject_id' => (int) $subjectId,
                        'sort'       => $sort++,
                        'cur_id'     => $curId,
                        'branch_id'  => $branchId,
                        'created_by' => $userId,
                        'updated_by' => $userId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

            if (!empty($rows)) {
                GradeSubjectOrder::query()->insert($rows);
            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Subject order saved for this grade',
                'data'    => [
                    'grade_id' => $gradeId,
                    'parents'  => $parents,
                    'children' => $children,
                ],
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    private function resolveCurId(): ?int
    {
        $curId = $this->getCur();

        return ($curId !== null && $curId !== '' && $curId !== '*')
            ? (int) $curId
            : null;
    }
}
