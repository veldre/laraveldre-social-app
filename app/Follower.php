<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{

    protected $fillable = ['leader_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }



}
