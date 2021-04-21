<?php

namespace App\Models;

use App\Notifications\MailResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Date\Date;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable {

    use Notifiable;
    use HasRoles;



    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [
        'name',        
        'type_document',        
        'document',
        'mobile',
        'phone',
        'economic_activity',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = ['password', 'change_password'];

    public function getLastLoginAttribute($date) {
        return new Date($date);
    }

    public function setPasswordAttribute($password) {
        $this->attributes['password'] = bcrypt($password);
    }

    protected function hasTooManyLoginAttempts(Request $request) {
        $maxLoginAttempts = 4;
        $lockoutTime = 5; // In minutes
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), $maxLoginAttempts, $lockoutTime
        );
    }

    public function sendPasswordResetNotification($token) {
        $this->notify(new MailResetPasswordNotification($token));    
    }

    public function address(){
        return $this->hasMany(CustomerAddress::class, 'customer_id')->with('state', 'city')->orderBy('principal', 'DESC')->orderBy('created_at', 'DESC');
    }

    public function orders(){
        return $this->hasMany(Order::class, 'customer_id')->with('items', 'status');
    }

}

