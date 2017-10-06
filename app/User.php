<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'firstname', 'lastname', 'email', 'gender', 'password',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function fullname()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function isAdmin() {
        $roles = $this->roles;
        if(count($roles) > 0) {
            return true;
        }
        return false;
    }
}
