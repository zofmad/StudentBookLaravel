<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Class extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'updated_at'
    ];

    /**
    * Get all of the classes users.
    */

    public function users()
   {
       return $this->morphMany('App\Models\User', 'usertable');
   }

   /**
    * The subjects that belong to the class.
    */
   public function subjects()
   {
       return $this->belongsToMany('App\Models\Subject');
   }




}
