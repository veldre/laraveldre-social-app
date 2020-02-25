<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = ['title', 'text'];

    public function user()
    {
        return $this->belongsTo(User::class);
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
