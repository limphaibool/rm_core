<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceAction extends Model
{
    protected $fillable = ['code', 'name'];
    protected $primaryKey = 'action_id';
    use HasFactory;
    public function permissions()
    {
        return $this->hasMany(Permission::class, 'action_id');
    }
}
