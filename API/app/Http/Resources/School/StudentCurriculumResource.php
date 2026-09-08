<?php

namespace App\Http\Resources\School;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentCurriculumResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'student_id'      => $this->student_id,
            'curriculum_id'   => $this->curriculum_id,
            'branch_id'       => $this->branch_id,
            'student_card_id' => $this->student_card_id,
            'rfid'            => $this->rfid,
            'start_date'      => $this->start_date,
            'end_date'        => $this->end_date,
            'is_active'       => $this->is_active,
            'is_transfer'     => $this->is_transfer,
            'is_graduate'     => $this->is_graduate,
            'description'     => $this->description,

            'name_en'    => $this->student?->name_en,
            'name_kh'    => $this->student?->name_kh,
            'photo_path' => $this->student?->photo_path,
            'gender'     => $this->student?->gender,
            'nation'     => $this->student?->nation,
            'dob'        => $this->student?->dob,
            'phone'      => $this->student?->phone,
            'email'      => $this->student?->email,
        ];
    }
}
