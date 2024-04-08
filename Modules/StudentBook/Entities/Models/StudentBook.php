<?php

namespace Modules\StudentBook\Entities\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentBook extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\StudentBook\Database\factories\Models/StudentBookFactory::new();
    }
}
