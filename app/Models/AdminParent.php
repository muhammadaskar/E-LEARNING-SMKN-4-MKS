<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminParent extends Model
{
    use HasFactory;

    protected $table = 'parents';

    protected $fillable = [
        'user_id', 'student_id', 'nik', 'is_active'
    ];
}
