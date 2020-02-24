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

//    public static function getFollowersInOrder(int $id)
//    {
//        $followers = self::orderBy('created_at', 'DESC')
//            ->where(['leader_id' => $id]);
//
//        return $followers;
//    }

//    public static function getFollowingsInOrder(int $id)
//    {
//        $followings = Follower::orderBy('created_at', 'DESC')
//            ->where(['user_id' => $id]);
//
//        return $followings;
//    }


}
