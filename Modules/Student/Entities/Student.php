<?php

namespace Modules\Student\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Book\Entities\Book;
use Modules\School\Entities\School;
use Modules\StudentBook\Entities\StudentBook;

class Student extends Model
{
    // use HasFactory;
    protected $table = 'students';
    protected $fillable = ['name', 'birthday', 'gender', 'grade_level', 'address', 'parent_guardian_name', 'phone', 'email', 'id_card', 'id_school'];

    // protected static function newFactory()
    // {
    //     return \Modules\Student\Database\factories\StudentFactory::new();
    // }

    public function school()
    {
        return $this->belongsTo(School::class, 'id_school', 'id');
    }

    public function studentBook()
    {
        return $this->hasMany(StudentBook::class, 'id', 'id_student');
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'student_books', 'id_student', 'id_book')->withPivot(['checkout_date', 'return_date']);
    }
}
