<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function categories() 
    {
        return $this->belongsToMany('App\Category')->withTimestamps();
    }

    public function quizzes()
    {
        return $this->hasMany('App\Quiz');
    }
}
