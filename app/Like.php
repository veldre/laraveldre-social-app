<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id', 'like'];

    public function likeable()
    {
        return $this->morphTo();
    }

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'likeable');
    }

    public function users()
    {
        return $this->morphMany(User::class,'likeable');
    }
}
