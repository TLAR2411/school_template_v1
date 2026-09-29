<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use App\Models\Core\Branch;
use App\Models\School\Classes;
use App\Models\School\Curriculum;
use App\Models\School\FamilyMember;
use App\Models\School\ReportAccessToken;
use App\Models\School\Student;
use App\Models\School\StudentClass;
use App\Models\School\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GeneralInfoController extends Controller
{
    public function year_list()
    {
        try {
            $data = Year::query()
                ->where('is_active', true)
                ->orderBy('id', 'asc')
                ->get();
            return response()->json([
                "status" => true,
                "data" => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function curriculum_list()
    {
        try {
            $data = Curriculum::query()
                ->where('is_active', true)
                ->orderBy('id', 'asc')
                ->get();
            return response()->json([
                "status" => true,
                "data" => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function branch_list()
    {
        try {
            $data = Branch::query()
                ->where('is_active', true)
                ->orderBy('id', 'asc')
                ->get();
            return response()->json([
                "status" => true,
                "data" => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getCode(Request $request)
    {
        $request->validate([
            'class_id' => 'required|integer',
            'student_id' => 'required|integer',
        ]);

        try {
            $userId = Auth::id();
            $classId = (int) $request->class_id;
            $studentId = (int) $request->student_id;

            $familyIds = FamilyMember::query()
                ->where('user_id', $userId)
                ->where('is_active', true)
                ->pluck('family_id');

            $allowed = StudentClass::query()
                ->where('class_id', $classId)
                ->where('student_id', $studentId)
                ->where('is_active', true)
                ->whereIn('student_id', function ($query) use ($familyIds) {
                    $query->select('student_id')
                        ->from('family_students')
                        ->whereIn('family_id', $familyIds)
                        ->where('is_active', true);
                })
                ->exists();

            if (!$allowed) {
                return response()->json([
                    'status' => false,
                    'message' => 'Student/class not allowed',
                ], 403);
            }

            $token = ReportAccessToken::query()
                ->where('class_id', $classId)
                ->where('student_id', $studentId)
                ->first();

            if (!$token) {
                $token = ReportAccessToken::create([
                    'class_id' => $classId,
                    'student_id' => $studentId,
                    'code' => hash('sha256', $classId . '-' . $studentId . '-' . Str::random(32)),
                ]);
            }

            $webBase = rtrim(env('WEB_URL', env('APP_URL')), '/');
            $url = "{$webBase}/app/report-student-individual?class_id={$classId}&student_id={$studentId}&code={$token->code}";

            return response()->json([
                'status' => true,
                'data' => [
                    'class_id' => $classId,
                    'student_id' => $studentId,
                    'code' => $token->code,
                    'url' => $url,
                ],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Public endpoint for WebView report page — validates access code.
     */
    public function showReport(Request $request)
    {
        $request->validate([
            'class_id' => 'required|integer',
            'student_id' => 'required|integer',
            'code' => 'required|string',
        ]);

        try {
            $classId = (int) $request->class_id;
            $studentId = (int) $request->student_id;
            $code = (string) $request->code;

            $token = ReportAccessToken::query()
                ->where('class_id', $classId)
                ->where('student_id', $studentId)
                ->where('code', $code)
                ->first();

            if (!$token) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid report link',
                ], 403);
            }

            $student = Student::query()
                ->where('id', $studentId)
                ->where('is_active', true)
                ->first(['id', 'name_en', 'name_kh', 'photo_path', 'gender', 'dob']);

            $class = Classes::query()
                ->where('id', $classId)
                ->with([
                    'year:id,name',
                    'shift:id,name_en,name_kh',
                    'classtype:id,name_en,name_kh',
                    'grade:id,name_en,name_kh,cur_id,symbol',
                ])
                ->first(['id', 'name_en', 'name_kh', 'grade_id', 'year_id', 'shift_id', 'class_type_id']);

            if (!$student || !$class) {
                return response()->json([
                    'status' => false,
                    'message' => 'Student or class not found',
                ], 404);
            }

            $curriculum = null;
            if ($class->grade?->cur_id) {
                $curriculum = Curriculum::query()
                    ->where('id', $class->grade->cur_id)
                    ->first(['id', 'name_en', 'name_kh', 'symbol']);
            }

            return response()->json([
                'status' => true,
                'data' => [
                    'class_id' => $classId,
                    'student_id' => $studentId,
                    'curriculum' => $curriculum ? [
                        'id' => $curriculum->id,
                        'symbol' => $curriculum->symbol,
                        'name_en' => $curriculum->name_en,
                        'name_kh' => $curriculum->name_kh,
                    ] : null,
                    'student' => [
                        'id' => $student->id,
                        'name_en' => $student->name_en,
                        'name_kh' => $student->name_kh,
                        'photo_path' => $student->photo_path,
                        'gender' => $student->gender,
                        'dob' => $student->dob,
                    ],
                    'class' => [
                        'id' => $class->id,
                        'name_en' => $class->name_en,
                        'name_kh' => $class->name_kh,
                        'year' => $class->year ? [
                            'id' => $class->year->id,
                            'name' => $class->year->name,
                        ] : null,
                        'shift' => $class->shift ? [
                            'id' => $class->shift->id,
                            'name_en' => $class->shift->name_en,
                            'name_kh' => $class->shift->name_kh,
                        ] : null,
                        'classtype' => $class->classtype ? [
                            'id' => $class->classtype->id,
                            'name_en' => $class->classtype->name_en,
                            'name_kh' => $class->classtype->name_kh,
                        ] : null,
                        'grade' => $class->grade ? [
                            'id' => $class->grade->id,
                            'name_en' => $class->grade->name_en,
                            'name_kh' => $class->grade->name_kh,
                            'symbol' => $class->grade->symbol,
                        ] : null,
                    ],
                ],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
