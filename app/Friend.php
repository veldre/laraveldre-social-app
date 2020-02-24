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


    public static function getFriendsInOrder(int $id)
    {
        $friends = self::orderBy('created_at', 'DESC')
            ->where(['friend_id' => $id, 'accepted' => 1]);

        return $friends;
    }


    public static function getUnconfirmedFriendsInOrder()
    {
        $friends = self::orderBy('created_at', 'DESC')
            ->where(['friend_id' => auth()->user()->id, 'accepted' => 0]);

        return $friends;
    }




    public static function getFriendRequest(int $id)
    {
        $friendRequest = self::where(['user_id' => $id, 'friend_id' => auth()->user()->id])->first();
        return $friendRequest;
    }



}
