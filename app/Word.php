<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    
    protected $guarded = ['id'];

    public function question()
    {
        return $this->belongsTo('App\Question');
    }

    public function isCorrect($answer)
    {
        return $this->where('option', $answer);
    }
}
