<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discuss extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'topic',
        'due_date',
    ];
}
