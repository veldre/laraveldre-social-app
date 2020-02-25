<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{

    protected $fillable = ['friend_id','accepted'];

    public function user()
    {
        return $this->belongsTo(User::class, 'friend_id');
    }



}
