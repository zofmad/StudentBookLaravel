<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'student_id', 'subject_id', 'note', 'value'
  ];




  /**
     * Get the grade changes in history for the grade.
     */
    public function gradesHistory()
    {
        return $this->hasMany('App\Models\GradesHistory');
    }



    /**
     * Get the student that is related to the grade.
     */
    public function student()
    {
        return $this->belongsTo('App\Models\User');
    }



    /**
     * Get the subject that is related to the grade.
     */
    public function subject()
    {
        return $this->belongsTo('App\Models\Subject');
    }

}
