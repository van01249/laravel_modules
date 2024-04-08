<?php

namespace Modules\Role\Entities\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Entities\Models\User;

class Role extends Model
{
    // use HasFactory;

    protected $table = 'roles';

    // protected $fillable = ['name', 'show', ''];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles')->withPivot(['user_id', 'role_id']);
    }

    protected static function newFactory()
    {
        return \Modules\Role\Database\factories\Models / RoleFactory::new();
    }
}
