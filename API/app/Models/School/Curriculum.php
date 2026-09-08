<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Scope;

class Curriculum extends Model
{
    protected $table = 'curriculums';
    protected $fillable = [
        'name_en',
        'name_kh',
        'symbol',
        'description',
        'is_active',
        'created_by',
        'updated_by',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    #[Scope]
    public function filter($query, $filters)
    {
        return $query->when(!empty($filters['search']), function ($q) use ($filters) {
            $q->where(function ($query) use ($filters) {
                $query->where('name_kh', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('name_en', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('symbol', 'like', '%' . $filters['search'] . '%');
            });
        });
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_curriculums')
            ->withPivot('created_by', 'updated_by', 'deleted_by', 'deleted_at', 'is_active', 'is_transfer', 'is_graduate', 'start_date', 'end_date')
            ->withTimestamps();
    }
}