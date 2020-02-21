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
        $friendsCount = self::where(['friend_id' => $id, 'accepted' => 1])->count();
        return $friendsCount;
    }

    public static function getFriendRequest(int $id)
    {
        $friendRequest = self::where(['user_id' => $id, 'friend_id' => auth()->user()->id])->first();
        return $friendRequest;
    }

}
