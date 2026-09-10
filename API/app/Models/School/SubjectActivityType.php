<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Model;

class SubjectActivityType extends Model
{
    protected $table = 'subject_activity_type';
    protected $fillable = [
        "name_en",
        "name_kh",
        "symbol",
        "is_activity"
    ];

    protected $hidden = [
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_by',
        'deleted_at'
    ];
}
