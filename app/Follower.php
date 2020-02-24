<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }

    public static function getFollowersInOrder(int $id)
    {
        $followers = self::orderBy('created_at', 'DESC')
            ->where(['leader_id' => $id]);

        return $followers;
    }


}
