<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function lesson()
    {
        return $this->belongsTo('App\Lesson');
    }

    public function followedUser()
    {
        return User::findOrFail($this->action_id);
    }
}
