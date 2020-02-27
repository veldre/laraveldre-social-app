<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = ['cover_image', 'name', 'description'];


    public function photos()
    {
        return $this->hasMany(Photo::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
