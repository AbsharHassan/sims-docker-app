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
        Schema::create('academics', function (Blueprint $table) {
            $table->id('academic_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('semester');
            $table->string('subject_1')->nullable();
            $table->string('subject_2')->nullable();
            $table->string('subject_3')->nullable();
            $table->string('subject_4')->nullable();
            $table->string('subject_5')->nullable();
            $table->string('subject_6')->nullable();
            $table->string('subject_7')->nullable();
            $table->string('subject_8')->nullable();
            $table->string('subject_9')->nullable();
            $table->string('subject_10')->nullable();
            $table->string('subject_1_id')->nullable();
            $table->string('subject_2_id')->nullable();
            $table->string('subject_3_id')->nullable();
            $table->string('subject_4_id')->nullable();
            $table->string('subject_5_id')->nullable();
            $table->string('subject_6_id')->nullable();
            $table->string('subject_7_id')->nullable();
            $table->string('subject_8_id')->nullable();
            $table->string('subject_9_id')->nullable();
            $table->string('subject_10_id')->nullable();
            $table->integer('subj_credit_1')->nullable();
            $table->integer('subj_credit_2')->nullable();
            $table->integer('subj_credit_3')->nullable();
            $table->integer('subj_credit_4')->nullable();
            $table->integer('subj_credit_5')->nullable();
            $table->integer('subj_credit_6')->nullable();
            $table->integer('subj_credit_7')->nullable();
            $table->integer('subj_credit_8')->nullable();
            $table->integer('subj_credit_9')->nullable();
            $table->integer('subj_credit_10')->nullable();
            $table->char('subj_grade_1')->nullable();
            $table->char('subj_grade_2')->nullable();
            $table->char('subj_grade_3')->nullable();
            $table->char('subj_grade_4')->nullable();
            $table->char('subj_grade_5')->nullable();
            $table->char('subj_grade_6')->nullable();
            $table->char('subj_grade_7')->nullable();
            $table->char('subj_grade_8')->nullable();
            $table->char('subj_grade_9')->nullable();
            $table->char('subj_grade_10')->nullable();
            $table->integer('total_credit_hours')->nullable();
            $table->decimal('total_grade_points')->nullable();
            $table->decimal('sgpa')->nullable();
            $table->decimal('cgpa', 3, 2)->nullable();
            $table->foreign('student_id')->references('id')->on('student_data')
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
        Schema::dropIfExists('academics');
    }
};
