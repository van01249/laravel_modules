<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->integer('id_school');
            $table->string('name');
            $table->date('birthday');
            $table->integer('gender'); //1: Nam, 2: Nữ, 3: Giới tính thứ 3
            $table->integer('grade_level')->default('');
            $table->string('address');
            $table->string('parent_guardian_name');
            $table->string('phone');
            $table->string('email')->default('');
            $table->string('id_card')->default('');
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
        Schema::dropIfExists('students');
    }
}
