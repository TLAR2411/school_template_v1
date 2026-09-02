<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DataTableResource;
use App\Models\Core\Branch;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BranchController extends Controller
{

    public function all(Request $request)
    {
        try {
            $branches = Branch::query()
                ->where('is_active', true)->get();

            return response()->json([
                'status' => true,
                'data' => $branches
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function show(Request $request)

    {
        try {
            $branches = Branch::findOrFail($request->id);
            return response()->json([
                'status' => true,
                'data' => $branches
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function list(Request $request)
    {
        try {
            $branches = Branch::paginate($request->limit);
            $branches = DataTableResource::collection($branches)->response()->getData(true);
            return response()->json([
                'status' => true,
                'data' => $branches
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $insert = $request->all();
            $insert['start_date'] = Carbon::parse($request->start_date)->format('Y-m-d');
            Branch::create($insert);
            $result['message'] = "Successfully created branch!";

            return response()->json([
                'status' => true,
                'message' => "Successfully created branch!"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $branch = Branch::findOrFail($request->id);
            $branch->name_kh = $request->name_kh;
            $branch->name_en = $request->name_en;
            $branch->abbr = $request->abbr;
            $branch->contact = $request->contect;
            $branch->house_no = $request->house_no;
            $branch->street = $request->street;
            $branch->village_code = $request->village_code;
            $branch->region = $request->region;
            $branch->save();

            return response()->json([
                'status' => true,
                'message' => "Successfully updated branch!"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request)
    {
        try {
            Branch::findOrFail($request->id)->delete();

            return response()->json([
                'status' => true,
                'message' => "Successfully deleted branch!"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function disable(Request $request)
    {
        try {
            $branch = Branch::findOrFail($request->id);
            $branch->is_active = $branch->is_active == true ? false : true;
            $branch->save();

            return response()->json([
                'status' => true,
                'message' => $branch->is_active == 1 ? "Successfully open branch!" : "Successfully disable branch!"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
