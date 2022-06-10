<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'assignment_id',
        'file',
        'nilai',
        'status'
    ];
}
