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

    public function correctAnswer()
    {
        return $this->words()->where('is_correct', 1);
    }
}

