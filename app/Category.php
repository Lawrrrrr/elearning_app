<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
 
    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    public function ownedQuestions()
    {
        return Question::where('category_id', $this->id);
    }
}
