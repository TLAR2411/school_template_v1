<?php

namespace App\Models\Auth;

use Illuminate\Support\Str;
use Laratrust\Models\Permission as PermissionModel;

class Permission extends PermissionModel
{
    public $guarded = [];

    protected $fillable = [
    'name',
    'display_name',
    'description',
    'group',
];

    public static function slug(?string $value): string
    {
        return (string) Str::of((string) $value)
            ->trim()
            ->lower()
            ->replaceMatches('/[^a-z0-9]+/', '-')
            ->trim('-');
    }

    public static function makeName(?string $displayName, ?string $group): string
    {
        $action = static::slug($displayName);
        $groupSlug = static::slug($group);

        if ($action === '' || $groupSlug === '') {
            return '';
        }

        return $action.'-'.$groupSlug;
    }
}
