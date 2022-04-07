<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'email',
        'nohp',
        'username',
        'password'
    ];

    protected $hidden =[
        'password',
        'is_admin'
    ];
}
