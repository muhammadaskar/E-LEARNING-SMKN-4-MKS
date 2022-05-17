<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $tableName = 'admins';

    protected $fillable = [
        'user_id', 'nik'
    ];
}
