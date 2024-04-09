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
            $table->integer('id_book');
            $table->integer('id_student');
            $table->boolean('is_back')->default(false); //Trạng thái trả sách
            $table->date('returned_date')->default(Carbon::now()); //Ngày đã trả sách
            $table->date('checkout_date'); //Ngày mượn 
            $table->date('return_date'); //Ngày hẹn trả sách
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
