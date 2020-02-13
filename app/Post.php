<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{


    protected $fillable = ['title', 'text'];
//
//    public function post()
//    {
//        return $this->belongsTo(User::class, 'user_id');
//    }


    public function user()
    {
        return $this->belongsTo(User::class); // tas pats, kas SELECT * FROM post WHERE user_id = konkrēta jūzera id
    }




}
