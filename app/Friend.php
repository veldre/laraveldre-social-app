<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $guarded = [];

    public function checkFriendRequest(int $receiver_id)
    {
        $friendshipRequest = self::where([
            'user_id' => auth()->user()->id,
            'friend_id' => $receiver_id])->first();

        return $friendshipRequest['id'];
    }

}
