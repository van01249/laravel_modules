<?php

namespace Modules\UserRole\Entities\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Role\Entities\Models\Role;

class UserRole extends Model
{
    // use HasFactory;

    protected $table = 'user_roles';
    protected $fillable = ['user_id', 'role_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    protected static function newFactory()
    {
        return \Modules\UserRole\Database\factories\Models / UserRoleFactory::new();
    }
}
