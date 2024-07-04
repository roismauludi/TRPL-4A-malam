<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'users';

    protected $fillable = [
        'id_staff',
        'nama',
        'email',
        'password',
        'foto',
        'level',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
