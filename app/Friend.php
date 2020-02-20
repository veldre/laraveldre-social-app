<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $guarded = [];

    public static function checkFriendRequest(int $receiver_id)
    {
        $friendshipRequest = self::where([
            'user_id' => auth()->user()->id,
            'friend_id' => $receiver_id])->first();

        return $friendshipRequest;
    }

    public function checkIfFriends(int $id)
    {
        $friendStatus = Friend::checkFriendRequest($id);
        if ($friendStatus['accepted'] != 0) {
            return true;
        }
    }

}
