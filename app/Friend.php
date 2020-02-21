<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getFriendsCount(int $id)
    {
        $friendsCount = self::where(['user_id' => $id, 'accepted' => 1])->count();
        return $friendsCount;
    }

    public static function getFriendRequest(int $id)
    {
        $friendRequest = self::where(['user_id' => $id, 'friend_id' => auth()->user()->id])->first();
        return $friendRequest;
    }



//
//    public function checkIfFriends(int $id)
//    {
//
//        $friendStatus = self::checkFriendRequest($id);
//        if ($friendStatus['accepted'] != 0) {
//            return true;
//        }
//    }
//
//    public function checkFriendRequest(int $receiver_id)
//    {
//        $friendshipRequest = self::where([
//            'user_id' => auth()->user()->id,
//            'friend_id' => $receiver_id])->first();
//
//        return $friendshipRequest;
//    }


}
