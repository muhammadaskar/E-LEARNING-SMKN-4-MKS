<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMateriAccessStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'materi_id',
        'student_id',
        'status_pengerjaan'
    ];
}
