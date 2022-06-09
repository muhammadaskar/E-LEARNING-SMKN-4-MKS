<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentEvaluationQuestionAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'evaluation_id',
        'student_id',
        'answer1',
        'answer2',
        'answer3'
    ];
}
