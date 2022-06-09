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
        Schema::create('student_evaluation_question_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evaluation_id')->constrained('evaluation_questions');
            $table->foreignId('student_id')->constrained('students');
            $table->string('answer1');
            $table->string('answer2');
            $table->string('answer3');
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
        Schema::dropIfExists('student_evaluation_question_answers');
    }
};
