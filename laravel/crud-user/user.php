<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as AuthUser;

class User extends AuthUser
{
    use HasFactory;

    protected $table = 'tb_user';
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nama_user',
        'email',
        'password',
        'level',
    ];
}
