<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Http\Resources\DataTableResource;
use App\Models\School\Subject;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class SubjectController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validate = $request->validate([
                'name_en' => 'required',
                'name_kh' => 'required',
            ]);

            Subject::create([
                'name_en' => $validate['name_en'],
                'name_kh' => $validate['name_kh'],
                'name_cn' => $request->name_cn,
                'edu_id' => $request->edu_id,
                'cur_id' => $this->getCur(),
                'branch_id' => $this->getBranch(),
                'parent_id' => $request->parent_id,
                "symbol" => $request->code,
                'created_by' => auth('api')->id()
            ]);

            return response()->json([
                'message' => "Create Success",
                'status' => true
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                "message" => $th->getMessage()
            ]);
        }
    }

    public function list(Request $request)
    {
        try {
            $data = Subject::query()
                ->whereCurriculum($this->getCur())
                // ->whereBranch($this->getBranch())
                ->withCount('children')
                ->with(['children:id,parent_id,name_en,name_kh'])
                ->filter($request->filter)
                ->paginate($request->limit);
            $data = DataTableResource::collection($data)->response()->getData(true);

            return response()->json([
                'data' => $data,
                "status" => true,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                "message" => $th->getMessage()
            ]);
        }
    }

    public function all()
    {
        try {
            $data = Subject::query()
                ->whereCurriculum($this->getCur())
                ->where('parent_id', null)
                // ->whereBranch($this->getBranch())
                ->get();

            return response()->json([
                'data' => $data,
                'status' => true
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                "message" => $th->getMessage()
            ]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $data = Subject::findOrFail($request->id)->delete();
            return response()->json([
                'status' => true,
                "message" => "Delete Success"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                "message" => $th->getMessage()
            ]);
        }
    }

    public function show(Request $request)
    {
        try {
            $data = Subject::findOrFail($request->id);
            return response()->json([
                "status" => true,
                "data" => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                "message" => $th->getMessage()
            ]);
        }
    }

    public function update(Request $request)
    {
        try {
            $data = Subject::findOrFail($request->id);
            $data->update([
                "name_en" => $request->name_en,
                "name_kh" => $request->name_kh,
                "symbol" => $request->code,
                'parent_id' => $request->parent_id,

                "updated_by" => auth('api')->user()
            ]);
            return response()->json([
                'status' => true,
                "message" => "Update Success"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                "message" => $th->getMessage()
            ]);
        }
    }
}
