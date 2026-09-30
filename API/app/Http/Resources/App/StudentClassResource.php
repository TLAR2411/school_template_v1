<?php

namespace App\Http\Resources\App;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentClassResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "class_id" => $this->class_id,
            "student_id" => $this->student_id,

            'year' => [
                'name' => $this->class->year->name,
                'id' => $this->class->year->id
            ],

            'shift' => $this->class?->shift ? [
                'id' => $this->class->shift->id,
                'name_en' => $this->class->shift->name_en,
                'name_kh' => $this->class->shift->name_kh,
            ] : null,

            "class" => [
                "name_en" => $this->class->name_en ?? 'N/A',
                "name_kh" => $this->class->name_kh ?? 'N/A',
            ],
            "classtype" => $this->class?->classtype ? [
                'name_en' => $this->class->classtype->name_en,
                'name_kh' => $this->class->classtype->name_kh
            ] : null

        ];
    }
}
