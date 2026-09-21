<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Model;

class ReportTemplate extends Model
{
    protected $fillable = [
        'key',
        'branch_id',
        'config',
    ];

    protected $casts = [
        'config' => 'array',
        'branch_id' => 'integer',
    ];
}
