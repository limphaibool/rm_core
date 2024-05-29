<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = [
        'resource_id',
        'action_id'
    ];
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'roles_permissions', 'role_id', 'permission_id');
    }
    public function permResource(): BelongsTo
    {
        return $this->belongsTo(Resource::class, 'resource_id');
    }

    public function action(): BelongsTo
    {
        return $this->belongsTo(ResourceAction::class, 'action_id');
    }


    protected $primaryKey = 'permission_id';

}
