<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Model;

class ReportAccessToken extends Model
{
    protected $table = 'report_access_token';

    protected $fillable = [
        'class_id',
        'student_id',
        'code',
    ];
}
