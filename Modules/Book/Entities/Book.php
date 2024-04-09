<?php

namespace Modules\Book\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Student\Entities\Student;
use Modules\StudentBook\Entities\StudentBook;

class Book extends Model
{
    // use HasFactory;
    protected $table = 'books';

    protected $fillable = ['title', 'author', 'genre', 'publisher', 'publish_date', 'quantity', 'available'];

    // protected static function newFactory()
    // {
    //     return \Modules\Book\Database\factories\BookFactory::new();
    // }

    public function studentBook()
    {
        return $this->hasMany(StudentBook::class, 'id', 'id_book');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_books', 'id_book', 'id_student')->withPivot(['checkout_date', 'return_date']);
    }
}
