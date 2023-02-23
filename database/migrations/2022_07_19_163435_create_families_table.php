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
        Schema::create('families', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id');
            $table->string('father_name');
            $table->string('father_occupation');
            $table->string('mother_name')->nullable();
            $table->string('mother_occupation')->nullable();
            $table->string('home_phone')->nullable();
            $table->string('father_phone')->nullable();
            $table->string('mother_phone')->nullable();
            $table->string('address')->nullable();
            $table->integer('number_siblings')->nullable(); 
            $table->foreign('student_id')->references('id')->on('student_data')
                    ->constrained()
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->primary('student_id');
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
        Schema::dropIfExists('families');
    }
};
