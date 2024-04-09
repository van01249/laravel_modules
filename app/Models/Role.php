<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = ['name', 'id_parent'];

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_roles')->withPivot(['user_id', 'role_id']);
    }

    public function roles()
    {
        return $this->hasMany(Role::class, 'id_parent');
    }

    public function userRoles()
    {
        return $this->hasMany(UserRole::class, 'role_id');
    }
}
