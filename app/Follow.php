<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = ['follower_user_id', 'following_user_id'];

    public function tweets()
    {
        return $this->hasMany(Tweet::class, 'user_id');
    }
}
