<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Date\Date;

class User extends Authenticatable {

    use Notifiable;
    protected $fillable = [
        'name',     
        'city',
        'birthdate',
        'email',
        'address',
        'password',
    ];


    protected $hidden = ['password', 'change_password'];


    public function setPasswordAttribute($password) {
        $this->attributes['password'] = bcrypt($password);
    }


    public function favorites(){
        return $this->hasMany(Favorite::class, 'id_usuario');
    }

}

