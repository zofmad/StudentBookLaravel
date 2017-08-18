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
        'name', 'email', 'password', 'foreign_id', 'foreign_class'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // protected $guarded = array('id');



//By default, Laravel will use the fully qualified class name to store the type of the
// related model. For instance, given the example above where a
// Comment may belong to a Post or a Video, the default commentable_type would be either App\Post or App\Video.


    /**
     * Get all of the owning usertable models.
     */
    public function usertable()
    {
        return $this->morphTo();
    }

    /**
     * Get the grades changes in history for the teacher.
     */
    public function gradesChangesInHistory()
    {
        return $this->hasMany('App\Model\GradesHistory', 'teacher_id');
    }

    /**
     * Get the grades for the student.
     */
    public function grades()
    {
        return $this->hasMany('App\Model\Grade', 'student_id');
    }



}
