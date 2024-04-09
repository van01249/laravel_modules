<?php

namespace Modules\StudentBook\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Book\Entities\Book;
use Modules\Student\Entities\Student;

class StudentBook extends Model
{
    // use HasFactory;

    protected $table = 'student_books';

    protected $fillable = ['id_book', 'id_student', 'checkout_date', 'return_date'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'id_student', 'id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'id_book', 'id');
    }

    // protected static function newFactory()
    // {
    //     return \Modules\StudentBook\Database\factories\StudentBookFactory::new();
    // }
}
