<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Http\Resources\School\ClassDetailResource;
use App\Http\Resources\School\ClassResource;
use App\Models\School\Classes;
use App\Models\School\TeacherClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name_en' => 'nullable|string|max:255',
            'name_kh' => 'nullable|string|max:255',
            'grade_id' => 'required|integer|exists:grades,id',
            'year_id' => 'nullable|exists:years,id',
            'room_id' => 'nullable|exists:rooms,id',
            'symbol' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        // $yearId = $data['year_id'] ?? $this->getYear();
        // if (!$yearId || $yearId === '*') {
        //     return response()->json(['status' => false, 'message' => 'Please select a year'], 422);
        // }

        // $branchId = $this->getBranch();
        // if (!$branchId || $branchId === '*') {
        //     return response()->json(['status' => false, 'message' => 'Please select a branch'], 422);
        // }

        try {
            Classes::create([
                "name_en" => $data['name_en'],
                "name_kh" => $data['name_kh'],
                "grade_id" => $data['grade_id'],
                "room_id" => $data['room_id'] ?? null,
                'symbol' => $data['symbol'] ?? null,
                'description' => $data['description'] ?? null,
                'year_id' => $request->year_id,
                'class_type_id' => $request->class_type_id,
                'branch_id' => $this->getBranch(),
                'shift_id' => $request->shift_id,
                'is_active' => true,
                'created_by' => auth('api')->id(),
            ]);

            return response()->json(['status' => true, 'message' => 'Class created successfully']);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Class creation failed',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|exists:classes,id',
            'name_en' => 'nullable|string|max:255',
            'name_kh' => 'nullable|string|max:255',
            'grade_id' => 'required|integer|exists:grades,id',
            'year_id' => 'nullable|exists:years,id',
            'room_id' => 'nullable|exists:rooms,id',
            'symbol' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);

        try {
            $class = Classes::findOrFail($data['id']);
            $class->update([
                "name_en" => $data['name_en'],
                "name_kh" => $data['name_kh'],
                "grade_id" => $data['grade_id'],
                "room_id" => $data['room_id'] ?? null,
                'symbol' => $data['symbol'] ?? null,
                'description' => $data['description'] ?? null,
                'shift_id' => $request->shift_id,
                'class_type_id' => $request->class_type_id,
                'year_id' => $request->year_id,
                'branch_id' => $this->getBranch(),
                'updated_by' => auth('api')->id(),
            ]);

            return response()->json(['status' => true, 'message' => 'Class updated successfully']);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Class update failed',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    public function list(Request $request)
    {
        try {
            $yearId = $this->getYear();
            $branchId = $this->getBranch();
            $curriculumId = $this->getCur();

            $data = Classes::query()
                ->whereYear($yearId)
                ->whereBranch($branchId)
                ->with('shift')
                ->whereCurriculum($curriculumId)
                ->with([
                    'grade:id,name_en,name_kh,grade_level,edu_id',
                    'grade.educationLevel:id,name_en,name_kh',
                    'room:id,room_number',
                    'classtype:id,name_en,name_kh'
                ])
                ->filter($request->filter)
                ->latest('id')
                ->paginate($request->limit);

            $data = ClassResource::collection($data)->response()->getData(true);

            return response()->json(['status' => true, 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function show(Request $request)
    {
        try {
            $data = Classes::with([
                'grade:id,name_en,name_kh,grade_level,edu_id',
                'grade.educationLevel:id,name_en,name_kh,symbol',
                'room:id,room_number',
            ])
                ->findOrFail($request->id);

            return response()->json(['status' => true, 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function all()
    {
        try {
            $yearId = $this->getYear();
            $branchId = $this->getBranch();
            $curriculumId = $this->getCur();

            $data = Classes::query()
                ->where('is_active', true)
                ->with('shift')
                ->whereYear($yearId)
                ->whereBranch($branchId)
                ->whereCurriculum($curriculumId)
                ->orderBy('name_kh')
                ->get();

            return response()->json(['status' => true, 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function disable(Request $request)
    {
        try {
            $item = Classes::findOrFail($request->id);
            $item->update([
                'is_active' => !$item->is_active,
                'updated_by' => auth('api')->id(),
            ]);
            return response()->json(['status' => true, 'message' => 'Class disabled successfully']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()], 500);
        }
    }

    public function delete(Request $request)
    {
        try {

            Classes::findOrFail($request->id)->delete();
            return response()->json(['status' => true, 'message' => 'Class deleted successfully']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()], 500);
        }
    }

    /**
     * Class detail for the General tab (identity, setup, quick stats).
     * Request: { class_id }
     */
    public function detail(Request $request)
    {
        $request->validate([
            'class_id' => 'required|integer|exists:classes,id',
        ]);

        try {
            $class = Classes::query()
                ->with([
                    'grade:id,name_en,name_kh,grade_level,edu_id',
                    'grade.educationLevel:id,name_en,name_kh',
                    'room:id,room_number',
                    'year:id,name',
                    'shift:id,name_en,name_kh',
                    'classtype:id,name_en,name_kh',
                ])
                ->findOrFail($request->class_id);

            $stats = $this->buildClassStats($class->id);
            $classloadTeacher = $this->getClassloadTeacher($class->id);

            return response()->json([
                'status' => true,
                'data' => new ClassDetailResource($class, $stats, $classloadTeacher),
            ]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()], 500);
        }
    }

    /**
     * Quick counts for the General tab. Keep filters here so UI stays simple.
     */
    private function buildClassStats(int $classId): array
    {
        $students = DB::table('student_class')
            ->join('students', 'students.id', '=', 'student_class.student_id')
            ->where('student_class.class_id', $classId)
            ->whereNull('student_class.deleted_at')
            ->whereNull('students.deleted_at')
            ->where('student_class.is_active', true)
            ->selectRaw("
                COUNT(*) as student_total,
                SUM(CASE WHEN LOWER(students.gender) IN ('female', 'f') THEN 1 ELSE 0 END) as student_female,
                SUM(CASE WHEN LOWER(students.gender) IN ('male', 'm') THEN 1 ELSE 0 END) as student_male
            ")
            ->first();

        // Distinct teachers (not assistants) vs assistants — one person can appear on many subjects
        $teacherTotal = (int) TeacherClass::query()
            ->where('class_id', $classId)
            ->where('is_active', true)
            ->where(function ($q) {
                $q->where('is_assisstant', false)->orWhereNull('is_assisstant');
            })
            ->selectRaw('COUNT(DISTINCT teacher_id) as total')
            ->value('total');

        $assistantTotal = (int) TeacherClass::query()
            ->where('class_id', $classId)
            ->where('is_active', true)
            ->where('is_assisstant', true)
            ->selectRaw('COUNT(DISTINCT teacher_id) as total')
            ->value('total');

        return [
            'student_total' => (int) ($students->student_total ?? 0),
            'student_female' => (int) ($students->student_female ?? 0),
            'student_male' => (int) ($students->student_male ?? 0),
            'teacher_total' => $teacherTotal,
            'assistant_total' => $assistantTotal,
        ];
    }

    private function getClassloadTeacher(int $classId): ?array
    {
        $row = TeacherClass::query()
            ->where('class_id', $classId)
            ->where('is_active', true)
            ->where('is_classload', true)
            ->with('teacher:id,name_en,name_kh,photo_path')
            ->first();

        if (!$row?->teacher) {
            return null;
        }

        return [
            'id' => $row->teacher->id,
            'name_en' => $row->teacher->name_en,
            'name_kh' => $row->teacher->name_kh,
            'photo_path' => $row->teacher->photo_path,
        ];
    }

    public function teacherClass(Request $request)
    {
        $yearId = $this->getYear();
        $branchId = $this->getBranch();
        $curriculumId = $this->getCur();
        try {
            $data = Classes::query()
            ->where('is_active', true)
            ->whereYear($yearId)
            ->whereBranch($branchId)
            ->whereCurriculum($curriculumId)
            ->whereTeacher()
            ->with([
                'shift',
                'grade:id,name_en,name_kh,grade_level,edu_id',
                'grade.educationLevel:id,name_en,name_kh',
                'room:id,room_number',
                'classtype:id,name_en,name_kh',
            ])
            ->orderBy('name_kh')
            ->get();
                return response()->json(['status' => true, 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()], 500);
        }
    }
}
