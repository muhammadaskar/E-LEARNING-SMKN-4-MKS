<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'materi_id',
        'question1',
        'question2',
        'question3',
        'jawaban_a_pertanyaan_1',
        'jawaban_b_pertanyaan_1',
        'jawaban_c_pertanyaan_1',
        'jawaban_d_pertanyaan_1',
        'jawaban_benar_pertanyaan_1',
        'jawaban_a_pertanyaan_2',
        'jawaban_b_pertanyaan_2',
        'jawaban_c_pertanyaan_2',
        'jawaban_d_pertanyaan_2',
        'jawaban_benar_pertanyaan_2',
        'jawaban_a_pertanyaan_3',
        'jawaban_b_pertanyaan_3',
        'jawaban_c_pertanyaan_3',
        'jawaban_d_pertanyaan_3',
        'jawaban_benar_pertanyaan_3',
    ];
}
