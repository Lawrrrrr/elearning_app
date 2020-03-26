<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $guarded = ['id'];

    public function lesson()
    {
        return $this->belongsTo('App\Lesson');
    }

    public function question()
    {
        return $this->belongsTo('App\Question');
    }
}
