<?php

namespace App\Http\Resources\School;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Flat, frontend-friendly teacher detail payload.
 * Classes / subjects are scoped by the selected academic year.
 */
class TeacherDetailResource extends JsonResource
{
    public function __construct(
        $resource,
        protected array $branches = [],
        protected array $classes = [],
        protected array $stats = [],
        protected ?array $year = null,
    ) {
        parent::__construct($resource);
    }

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name_en' => $this->name_en,
            'name_kh' => $this->name_kh,
            'photo_path' => $this->photo_path,
            'gender' => $this->gender,
            'dob' => $this->dob,
            'nation' => $this->nation,
            'phone' => $this->phone,
            'email' => $this->email,
            'is_active' => (bool) $this->is_active,
            'is_teaching' => (bool) $this->is_teaching,
            'manage_branch' => (int) $this->manage_branch,

            'year_id' => $this->year['id'] ?? null,
            'year_name' => $this->year['name'] ?? null,

            'branches' => $this->branches,
            'branch_count' => count($this->branches),
            'is_multi_branch' => count($this->branches) > 1 || (int) $this->manage_branch === 2,

            'stats' => [
                'class_total' => (int) ($this->stats['class_total'] ?? 0),
                'subject_total' => (int) ($this->stats['subject_total'] ?? 0),
                'branch_total' => (int) ($this->stats['branch_total'] ?? count($this->branches)),
                'classload_total' => (int) ($this->stats['classload_total'] ?? 0),
                'assistant_total' => (int) ($this->stats['assistant_total'] ?? 0),
            ],

            'classes' => $this->classes,
        ];
    }
}
