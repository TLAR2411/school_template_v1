<?php

namespace App\Models\School;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    protected $fillable = [
        'name_en',
        'name_kh',
        'description',
        'is_active',
        'created_by',
        'updated_by',

    ];

    protected $hidden = ['created_by', 'updated_by', 'deleted_by'];

    public function studentLink()
    {
        return $this->hasMany(StudentFamily::class, 'family_id');
    }
    public function member(){
        return $this->hasMany(FamilyMember::class,'family_id');
    }

    #[Scope]
    public function filter($query, $filters)
    {
        return $query->when(!empty($filters['search']), function ($q) use ($filters) {
            $search = $filters['search'];
            $q->where(function ($q) use ($search) {
                $q->where('name_en', 'like', "%{$search}%")
                    ->orWhere('name_kh', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        });
    }
}
