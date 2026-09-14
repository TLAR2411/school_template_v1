<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Model;

class StudentFamily extends Model
{
    protected $table = "family_students";
    protected $fillable = [
        'student_id',
        'family_id',
        'is_active',
        'created_by',
        'updated_by'
    ];

    protected $hidden = ['created_by', 'updated_by', 'deleted_by'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
