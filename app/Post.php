<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class); // tas pats, kas SELECT * FROM post WHERE user_id = konkrēta jūzera id
    }

    public static function getPostsInOrder()
    {
        $posts = self::orderBy('updated_at', 'DESC')->where('id', '>', 0);
        return $posts;
    }

    public static function getPostsByUserInOrder(int $userId)
    {
        $userPosts = self::where('user_id', $userId)->get()->sortByDesc('updated_at');
        return $userPosts;
    }



}
