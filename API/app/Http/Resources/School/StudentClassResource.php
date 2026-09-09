<?php

namespace App\Http\Resources\School;

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
            "student_id" => $this->student_id,
            "name_en" => $this->student?->name_en,
            "name_kh" => $this->student?->name_kh,
            "dob" => $this->student?->dob,
            "gender" => $this->student?->gender,
            "nation" => $this->student?->nation,
            "photo_path" => $this->student?->photo_path,

        ];
    }
}
