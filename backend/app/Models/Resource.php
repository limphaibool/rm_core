<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    protected $primaryKey = 'resource_id';

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'resource_id');
    }
}
