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

    public function lessons()
    {
        return $this->hasMany('App\Lesson');
    }

    public function checkIfTakenCategory($category_id, $user_id)
    {
        return Lesson::where('category_id', $category_id)
                     ->where('user_id', $user_id);
    }
}
