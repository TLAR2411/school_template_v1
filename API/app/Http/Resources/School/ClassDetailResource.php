<?php

namespace App\Http\Resources\School;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Flat, frontend-friendly class detail payload.
 * Add new fields here when the General tab needs more info.
 */
class ClassDetailResource extends JsonResource
{
    public function __construct(
        $resource,
        protected array $stats = [],
        protected ?array $classloadTeacher = null,
    ) {
        parent::__construct($resource);
    }

    public function toArray(Request $request): array
    {
        return [
            // Identity
            'id' => $this->id,
            'name_en' => $this->name_en,
            'name_kh' => $this->name_kh,
            'symbol' => $this->symbol,
            'description' => $this->description,
            'is_active' => (bool) $this->is_active,

            // Academic
            'grade_id' => $this->grade_id,
            'grade_level' => $this->grade?->grade_level,
            'grade_name_en' => $this->grade?->name_en,
            'grade_name_kh' => $this->grade?->name_kh,
            'edu_name_en' => $this->grade?->educationLevel?->name_en,
            'edu_name_kh' => $this->grade?->educationLevel?->name_kh,

            // Setup
            'year_id' => $this->year_id,
            'year_name' => $this->year?->name,
            'room_id' => $this->room_id,
            'room_number' => $this->room?->room_number,
            'shift_id' => $this->shift_id,
            'shift_name_en' => $this->shift?->name_en,
            'shift_name_kh' => $this->shift?->name_kh,
            'class_type_id' => $this->class_type_id,
            'class_type_en' => $this->classtype?->name_en,
            'class_type_kh' => $this->classtype?->name_kh,

            // Homeroom / classload teacher (optional)
            'classload_teacher' => $this->classloadTeacher,

            // Counts for General tab cards
            'stats' => [
                'student_total' => (int) ($this->stats['student_total'] ?? 0),
                'student_female' => (int) ($this->stats['student_female'] ?? 0),
                'student_male' => (int) ($this->stats['student_male'] ?? 0),
                'teacher_total' => (int) ($this->stats['teacher_total'] ?? 0),
                'assistant_total' => (int) ($this->stats['assistant_total'] ?? 0),
            ],
        ];
    }
}
