<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $guarded  = ['id'];
    protected $appends  = ['module_name'];
    protected $table    = 'permissions';

    public function module() 
    {
        return $this->belongsTo(Module::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_role', 'permission_id', 'role_id');
    }

    public function getModuleNameAttribute()
    {
        return $this->module->name;
    }
}
