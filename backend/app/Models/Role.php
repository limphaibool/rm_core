<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Role extends Model
{
    use HasFactory, HasRecursiveRelationships;
    protected $fillable = [
        'role_name',
        'parent_id',
        'enabled',
    ];
    public function getLocalKeyName()
    {
        return 'role_id';

    }
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions', 'role_id', 'permission_id');
    }

    protected $primaryKey = 'role_id';
}
