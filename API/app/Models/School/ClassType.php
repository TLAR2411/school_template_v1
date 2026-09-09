<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Model;

class ClassType extends Model
{
    protected $table = 'class_type';
    protected $fillable = [
        'name_en',
        'name_kh',
        'created_by'
    ];
}
