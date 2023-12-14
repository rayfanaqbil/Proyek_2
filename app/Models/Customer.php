<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $table = 'customer';
    protected $primaryKey = 'kode_customer';
    protected $fillable = ['kode_customer', 'nama', 'email', 'username', 'password', 'telp'];
    protected $hidden = ['password'];
    protected $username = 'username';
}

