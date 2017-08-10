<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Foundation\Auth\User as AuthenticatableUser; (lar 5.2)
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
// use Zizaco\Entrust\HasRole;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
// use Illuminate\Contracts\Auth\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract,
CanResetPasswordContract
{
    use Notifiable;
    use EntrustUserTrait, Authenticatable, CanResetPassword;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
