<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    protected $guarded = ['id'];

    public function words()
    {
        return $this->hasMany('App\Word');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function quiz()
    {
        return $this->hasOne('App\Quiz');
    }

    public function correctAnswers()
    {
        return $this->words()->where('is_correct', 1);
    }

    public function userAnswers($lesson_id)
    {
        return $this->quiz()->where('lesson_id', $lesson_id);
    }
}

