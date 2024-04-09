<?php

namespace Modules\School\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class School extends Model
{
    // use HasFactory;
    protected $table = 'schools';
    protected $fillable = ['name', 'address', 'descriptions', 'phone', 'email'];

    // protected static function newFactory()
    // {
    //     return \Modules\School\Database\factories\SchoolFactory::new();
    // }
}
