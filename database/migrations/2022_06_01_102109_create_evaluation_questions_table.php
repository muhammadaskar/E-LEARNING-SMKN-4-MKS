<?php

use App\Models\TeacherMateri;
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
        Schema::create('evaluation_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TeacherMateri::class, 'materi_id');
            $table->string('question1');
            $table->string('question2');
            $table->string('question3');
            $table->string('jawaban_a_pertanyaan_1');
            $table->string('jawaban_b_pertanyaan_1');
            $table->string('jawaban_c_pertanyaan_1');
            $table->string('jawaban_d_pertanyaan_1');
            $table->string('jawaban_benar_pertanyaan_1');
            $table->string('jawaban_a_pertanyaan_2');
            $table->string('jawaban_b_pertanyaan_2');
            $table->string('jawaban_c_pertanyaan_2');
            $table->string('jawaban_d_pertanyaan_2');
            $table->string('jawaban_benar_pertanyaan_2');
            $table->string('jawaban_a_pertanyaan_3');
            $table->string('jawaban_b_pertanyaan_3');
            $table->string('jawaban_c_pertanyaan_3');
            $table->string('jawaban_d_pertanyaan_3');
            $table->string('jawaban_benar_pertanyaan_3');
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
        Schema::dropIfExists('evaluation_questions');
    }
};
