<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Models\School\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\School\GradingRule;
use App\Models\School\Assessment;

class GradingRuleController extends Controller
{
    public function list(Request $request)
    {
        try {
            $request->validate([
                'grade_id' => 'required',
            ]);

            $gradeId = $request->grade_id;
            $yearId = $request->year_id ?? $this->getYear();
            $termId = $request->term_id;
            // optional UI filter only — leave empty to see Social + Science + shared together
            $classTypeId = $request->class_type_id;

            // Filter RULES by grade (subjects have no grade_id)
            // subject_id is automatic from Subject::gradingRules()
            $ruleFilter = function ($q) use ($gradeId, $yearId, $termId, $classTypeId) {
                $q->where('grade_id', $gradeId)
                    ->when($yearId, function ($q) use ($yearId) {
                        $q->where(function ($q) use ($yearId) {
                            $q->where('year_id', $yearId)
                                ->orWhereNull('year_id');
                        });
                    })
                    // ->when($termId, fn($q) => $q->where('term_id', $termId))
                    ->when($classTypeId, fn($q) => $q->where('class_type_id', $classTypeId))
                    ->with([
                        'activityType:id,name_en,name_kh,symbol',
                        'classType:id,name_en,name_kh',
                        'assessments:id,ass_name,grading_rule_id,subject_id,max_score',
                    ])
                    ->orderBy('id');
            };

            $subjects = Subject::query()
                ->whereNull('parent_id')
                ->whereCurriculum($this->getCur())
                ->with([
                    'gradingRules' => $ruleFilter,
                    'children' => function ($q) use ($ruleFilter) {
                        $q->select('id', 'parent_id', 'name_en', 'name_kh', 'name_cn', 'symbol')
                            ->with(['gradingRules' => $ruleFilter])
                            ->orderBy('id');
                    },
                ])
                ->select('id', 'parent_id', 'name_en', 'name_kh', 'name_cn', 'symbol')
                ->orderBy('id')
                ->get()
                ->map(fn($subject) => $this->formatSubject($subject))
                ->filter(function ($subject) {
                    // keep if parent has rules OR any child has rules
                    return $subject['has_grading']
                        || collect($subject['children'])->contains(fn($c) => $c['has_grading']);
                })
                ->values();

            return response()->json([
                'status' => true,
                'data' => $subjects,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    private function formatSubject($subject)
    {
        return [
            'id' => $subject->id,
            'name_en' => $subject->name_en,
            'name_kh' => $subject->name_kh,
            'name_cn' => $subject->name_cn,
            'symbol' => $subject->symbol,
            'parent_id' => $subject->parent_id,
            'has_grading' => $subject->gradingRules->isNotEmpty(),
            'grading_rules' => $subject->gradingRules->map(function ($rule) {
                return [
                    'id' => $rule->id,
                    'grade_id' => $rule->grade_id,
                    'year_id' => $rule->year_id,
                    'term_id' => $rule->term_id,
                    'max_score' => $rule->max_score,
                    'percentage' => $rule->percentage,
                    'class_type_id' => $rule->class_type_id,
                    'class_type' => $rule->classType
                        ? [
                            'id' => $rule->classType->id,
                            'name_en' => $rule->classType->name_en,
                            'name_kh' => $rule->classType->name_kh,
                        ]
                        : null,
                    'activity' => $rule->activityType
                        ? [
                            'id' => $rule->activityType->id,
                            'name_en' => $rule->activityType->name_en,
                            'name_kh' => $rule->activityType->name_kh,
                            'symbol' => $rule->activityType->symbol,
                        ]
                        : null,
                    'assessments' => $rule->assessments->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'ass_name' => $item->ass_name,
                            'max_score' => $item->max_score,
                            'grading_rule_id' => $item->grading_rule_id,
                            'subject_id' => $item->subject_id,
                        ];
                    })->values(),
                ];
            })->values(),
            'children' => $subject->relationLoaded('children')
                ? $subject->children->map(fn($child) => $this->formatSubject($child))->values()
                : [],
        ];
    }



    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'grade_id' => 'required|integer',
                'subject_id' => 'required|integer|exists:subjects,id',
                'year_id' => 'nullable',
                'term_id' => 'nullable',
                'rules' => 'required|array|min:1',
                'rules.*.subject_activity_type_id' => 'required|integer|exists:subject_activity_type,id',
                'rules.*.class_type_id' => 'nullable|integer',
                'rules.*.percentage' => 'nullable|numeric|min:0|max:100',
                'rules.*.max_score' => 'required|numeric|min:0',
            ]);

            DB::beginTransaction();
            foreach ($validated['rules'] as $rule) {
                $data = GradingRule::create([
                    'grade_id' => $validated['grade_id'],
                    'subject_id' => $validated['subject_id'],
                    'year_id' => $validated['year_id'] ?? null,
                    'term_id' => $validated['term_id'] ?? null,
                    'subject_activity_type_id' => $rule['subject_activity_type_id'],
                    'class_type_id' => $rule['class_type_id'] ?? null,
                    'percentage' => $rule['percentage'] ?? null,
                    'max_score' => $rule['max_score'] ?? null,
                ]);
            }
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Grading rule created successfully',
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
            $data = GradingRule::findOrFail($request->id);
            Assessment::where('grading_rule_id', $data->id)->delete();
            $data->delete();
            return response()->json([
                'status' => true,
                'message' => "Delete Successful"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
