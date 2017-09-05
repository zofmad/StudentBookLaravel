<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class GradesHistory extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'grade_id', 'note', 'value_old', 'value_new', 'action', 'created_at'
    ];

    /**
     * Get the grade that is realated to change in grade history.
     */
    public function grade()
    {
        return $this->belongsTo('App\Models\Grade');
    }

    /**
     * Get the teacher that made change in grade history.
     */
    public function teacher()
    {
        return $this->belongsTo('App\Models\User');
    }








}
