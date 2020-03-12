<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Foundation\Auth\User as Authenticatable;

class Category extends Model
{
 
    protected $guarded = ['id'];

    public function isCategoryOwner($cond)
    {
        return Category::where('user_id', $cond, auth()->user()->id);
    }
}
