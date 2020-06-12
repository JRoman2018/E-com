<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticable
{
    use Notifiable;
    protected $guard = 'admin';
    protected $fillable = [
        'name', 'type', 'phone', 'email', 'password', 'image', 'status', 'created_at', 'updated_at',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
}
