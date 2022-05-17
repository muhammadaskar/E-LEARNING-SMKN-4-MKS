<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminStudent extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $fillable = [
        'user_id', 'nis', 'is_active'
    ];
}
