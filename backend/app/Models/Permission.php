<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = [
        'resource_id',
        'resource_action_id'
    ];
    protected $primaryKey = 'permission_id';
}
