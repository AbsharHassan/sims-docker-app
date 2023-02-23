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
        // Schema::create('course_marks', function (Blueprint $table) {
        //     $table->id('course_marks_id');
        //     $table->unsignedBigInteger('course_id');
        //     $table->integer('marks');
            
        //     $table->integer('bin1')->nullable();
        //     $table->integer('bin2')->nullable();
        //     $table->integer('bin3')->nullable();
        //     $table->integer('bin4')->nullable();
        //     $table->integer('bin5')->nullable();
        //     $table->integer('bin6')->nullable();
        //     $table->integer('bin7')->nullable();
        //     $table->integer('bin8')->nullable();
        //     $table->integer('bin9')->nullable();
        //     $table->integer('bin10')->nullable();
            
        //     $table->foreign('course_id')->references('course_id')->on('courses');
        //     $table->timestamps();
        // });
        Schema::create('course_marks', function (Blueprint $table) {
            $table->id('course_marks_id');
            $table->unsignedBigInteger('course_id');
            $table->integer('marks');
            $table->foreign('course_id')->references('course_id')->on('courses')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
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
        Schema::dropIfExists('course_marks');
    }
};
