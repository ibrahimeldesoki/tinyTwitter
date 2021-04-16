<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $fillable = ['text' , 'user_id'];

    public function user()
    {
        return $this->morphTo(User::class);
    }
}
