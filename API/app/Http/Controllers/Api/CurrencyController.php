<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DataTableResource;
use App\Models\Core\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurrencyController extends Controller
{
    public function all(Request $request)
    {
        try {
            $currencies = Currency::query()
                ->where('is_active', true)->get();

            return response()->json([
                'status' => true,
                'data' => $currencies
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
            $currencies = Currency::findOrFail($request->id);

            return response()->json([
                'status' => true,
                'data' => $currencies
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
            $currencies = Currency::orderBy("id")->paginate($request->limit);
            $currencies = DataTableResource::collection($currencies)->response()->getData(true);

            return response()->json([
                'status' => true,
                'data' => $currencies
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
            Currency::create($request->all());
            $result['message'] = "Successful Created Currency!";

            return response()->json([
                'status' => true,
                'message' => "Successful Created Currency!"
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
            $currencies = Currency::findOrFail($request->id);
            $currencies->currency_code = $request->currency_code;
            $currencies->name_kh = $request->name_kh;
            $currencies->name_en = $request->name_en;
            $currencies->abbr = $request->abbr;
            $currencies->exchange_rate = $request->exchange_rate;
            $currencies->save();

            return response()->json([
                'status' => true,
                'message' => "Successful Updated Currency!"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request) {}

    public function disable(Request $request)
    {
        try {
            $currencies = Currency::findOrFail($request->id);
            $currencies->is_active = $currencies->is_active == true ? false : true;
            $currencies->save();

            return response()->json([
                'status' => true,
                'message' => $currencies->is_active == 1 ? "Successful Opened Currency!" : "Successful Disabled Currency!"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function setDefault(Request $request)
    {
        DB::beginTransaction();
        try {

            Currency::query()->update([
                'default' => false
            ]);

            Currency::findOrFail($request->id)->update([
                'default' => true
            ]);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => "Successful set default currency!"
            ]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
