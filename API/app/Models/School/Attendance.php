<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendances';
    protected $fillable = [
        'student_id',
        'class_id',
        'teacher_id',
        'subject_id',
        'date',
        'reason',
        'is_late',
        'is_permission',
        'is_present',
        'is_approved',
        'created_by',
        'updated_by',
        'branch_id',
        'cur_id',
    ];

    protected $casts = [
        'date' => 'date',
        'is_late' => 'boolean',
        'is_permission' => 'boolean',
        'is_present' => 'boolean',
        'is_approved' => 'boolean',
    ];
}
