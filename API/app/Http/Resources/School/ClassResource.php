<?php

namespace App\Http\Resources\School;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name_en' => $this->name_en,
            'name_kh' => $this->name_kh,
            'symbol' => $this->symbol,
            'description' => $this->description,
            'is_active' => $this->is_active,
            'edu_name_kh' => $this->grade?->educationLevel?->name_kh,
            'edu_name_en' => $this->grade?->educationLevel?->name_en,
            'grade_level' => $this->grade?->grade_level,
            'grade_name_kh' => $this->grade?->name_kh,
            'grade_name_en' => $this->grade?->name_en,
            'room_number' => $this->room?->room_number,
            // 'class_type' => $this->classType
            'class_type_kh' => $this->classType?->name_kh,
            'class_type_en' => $this->classType?->name_en,
        ];
    }
}
