<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function categories()
    {
        return $this->hasMany('App\Category');
    }

    public function lessons()
    {
        return $this->hasMany('App\Lesson');
    }
    
    public function activities()
    {
        return $this->hasMany('App\Activity');
    }
    
    public function isAdmin()
    {
        if(!empty($this));
            return $this->user_type == 'admin';
    }

    public function unOwnedCategories()
    {
        return Category::where('user_id', "!=", $this->id);
    }

    public function followers()
    {
        return $this->belongsToMany('App\User', 'relationships', 
        'followed_id', 'follower_id')->withTimestamps();
    }

    public function followedUsers()
    {
        return $this->belongsToMany('App\User', 'relationships', 
        'follower_id', 'followed_id')->withTimestamps();
    }

    public function isFollowing($followed_id)
    {
        return $this->followedUsers()->where('followed_id', $followed_id)->exists();
    }

    public function activity()
    {
        return $this->morphOne('App\Activity', 'action');
    }
}

