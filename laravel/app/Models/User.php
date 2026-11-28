<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'user';
    protected $primaryKey = 'Id_user';
    public $timestamps = false;

    protected $fillable = ['Nama_user', 'password', 'email', 'role', 'Id_tim'];
    protected $hidden = ['password'];
    protected $casts = ['password' => 'hashed'];

    public function getRememberTokenName()
    {
        return '';
    }

    public function tim()
    {
        return $this->belongsTo(Tim::class, 'Id_tim', 'id_tim');
    }
}