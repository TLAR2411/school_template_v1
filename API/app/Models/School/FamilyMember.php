<?php

namespace App\Models\School;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    protected $fillable = [
        'name_en',
        'name_kh',
        'description',
        'is_active',
        'type',
        'phone',
        'email',
        'user_id',
        'created_by',
        'updated_by',
        'family_id'
    ];
    protected $hidden = ['created_by', 'updated_by', 'deleted_by'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
