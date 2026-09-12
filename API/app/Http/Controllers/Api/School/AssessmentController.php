<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\School\Assessment;
use App\Models\School\GradingRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssessmentController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'grading_rule_id' => 'required|integer|exists:grading_rules,id',
                'subject_id' => 'nullable|integer|exists:subjects,id',
                'assessments' => 'required|array|min:1',
                'assessments.*.ass_name' => 'required|string|max:255',
                'assessments.*.max_score' => 'required|numeric|min:0',
            ]);

            $rule = GradingRule::findOrFail($validated['grading_rule_id']);
            $subjectId = $validated['subject_id'] ?? $rule->subject_id;
            $ruleMax = (float) $rule->max_score;

            $totalMax = collect($validated['assessments'])
                ->sum(fn ($item) => (float) $item['max_score']);

            if ($totalMax > $ruleMax) {
                return response()->json([
                    'status' => false,
                    'message' => "Sum of assessment max scores ({$totalMax}) cannot exceed grading rule max ({$ruleMax})",
                ], 422);
            }

            DB::beginTransaction();

            // Replace all assessments for this rule with the submitted list
            Assessment::where('grading_rule_id', $rule->id)->delete();

            foreach ($validated['assessments'] as $item) {
                Assessment::create([
                    'ass_name' => $item['ass_name'],
                    'max_score' => $item['max_score'],
                    'grading_rule_id' => $rule->id,
                    'subject_id' => $subjectId,
                ]);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Assessments saved successfully',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $data = Assessment::findOrFail($request->id);
            $data->delete();

            return response()->json([
                'status' => true,
                'message' => 'Delete Successful',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
