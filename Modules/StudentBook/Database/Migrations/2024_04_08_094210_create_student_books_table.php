<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_books', function (Blueprint $table) {
            $table->id();
            $table->integer('id_student');
            $table->integer('id_book');
            $table->boolean('is_back')->default(false); //Trang thai tra sach
            $table->date('checkout_date'); //Ngay muon sach
            $table->date('return_date'); //Ngay hen tra sach
            $table->date('returned_data')->default(Carbon::now()); //Ngay tra sach
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_books');
    }
}
