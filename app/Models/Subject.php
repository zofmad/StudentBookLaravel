<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'teacherId', 'name', 'password', 'updated_at'
    ];

    /**
    * Get all of the subject's users.
    */

    public function users()
   {
       return $this->morphMany('App\Models\User', 'usertable');
   }


   /**
    * The classes that belong to the subject.
    */
   public function classes()
   {
       return $this->belongsToMany('App\Models\Class');
   }
}
