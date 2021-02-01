<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'username', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles() {
        return $this->belongsToMany(Role::class);
    }

    public function eventClasses() {
        return $this->belongsToMany(EventClass::class);
    }

    public function isAdmin() {
        $isAdmin = false;
        $roles = Auth::user()->roles;

        foreach (Auth::user()->roles as $role) {
            if ($role->name == 'admin') {
                $isAdmin = true;
            }
        }

        return $isAdmin;
    }
}
