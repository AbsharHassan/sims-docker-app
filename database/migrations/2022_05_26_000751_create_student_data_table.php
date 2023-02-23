<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('student_data', function (Blueprint $table) {
            // $table->id('id');
            $table->unsignedBigInteger('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob');
            $table->date('joining_date');
            $table->longText('phone_number');
            $table->string('gender');
            $table->integer('fsc_marks');
            $table->year('fsc_year');
            $table->integer('fsc_div');
            $table->integer('matric_marks');
            $table->year('matric_year');
            $table->integer('matric_div');
            $table->integer('current_sem');
            $table->string('department');
            $table->string('degree');
            $table->string('syn');
            $table->longText('reason')->nullable();
            $table->string('img')->nullable();
            $table->timestamps();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_data');
    }
};
