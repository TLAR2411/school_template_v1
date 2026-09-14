<?php

namespace App\Http\Resources\School;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FamilyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name_en' => $this->name_en,
            'name_kh' => $this->name_kh,
            'description' => $this->description,
            'member' => $this->whenLoaded('member', function () {
                return $this->member->map(function ($member) {
                    return [
                        'id' => $member->id,
                        'name_en' => $member->name_en,
                        'name_kh' => $member->name_kh,
                        'type' => $member->type,
                        'phone' => $member->phone ?? $member->user?->contact,
                        'email' => $member->email ?? $member->user?->email,
                        'user_id' => $member->user_id,
                        'user' => $member->user ? [
                            'id' => $member->user->id,
                            'username' => $member->user->username,
                            'email' => $member->user->email,
                            'contact' => $member->user->contact,
                        ] : null,
                    ];
                })->values();
            }),
            'student' => $this->whenLoaded('studentLink', function () {
                return $this->studentLink->map(function ($link) {
                    $student = $link->student;

                    return [
                        'id' => $student?->id,
                        'student_family_id' => $link->id,
                        'student_id' => $link->student_id,
                        'name_en' => $student?->name_en,
                        'name_kh' => $student?->name_kh,
                        'photo_path' => $student?->photo_path,
                        'gender' => $student?->gender,
                        'dob' => $student?->dob,
                        'nation' => $student?->nation,
                    ];
                })->values();
            }),
        ];
    }
}
