<?php

namespace App\Models\School;

use App\Models\Core\Branch;
use Illuminate\Database\Eloquent\Model;

class TeacherBranch extends Model
{
    protected $table = 'teacher_branches';

    protected $fillable = [
        'teacher_id',
        'branch_id',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by',   
        'deleted_at',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
