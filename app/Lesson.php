<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category() 
    {
        return $this->belongsTo('App\Category');
    }

    public function quizzes()
    {
        return $this->hasMany('App\Quiz');
    }

    public function correctAnswers()
    {
        return $this->quizzes()->where('is_correct', 1);
    }

    public function activities()
    {
        return $this->hasMany('App\Activity');
    }

    public function activity()
    {
        return $this->morphOne('App\Activity', 'action');
    }
}
