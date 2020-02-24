<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
    protected $table = 'followers';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

        public static function getFollowingsInOrder(int $id)
    {
        $followings = self::orderBy('created_at', 'DESC')
            ->where(['follower_id' => $id]);

        return $followings;
    }
}
