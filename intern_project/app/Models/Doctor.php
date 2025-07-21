<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctors'; 

    protected $fillable = [
        'name',
        'user_role',
        'user_number',
        'user_password',
    ];

    protected $hidden = [
        'user_password', 
    ];
}
