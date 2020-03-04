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


    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }


    public static function getPostsInOrder()
    {
        $posts = self::orderBy('updated_at', 'DESC')->where('id', '>', 0)->paginate(10);
        return $posts;
    }


    public static function getPostsByUserInOrder(int $userId)
    {
        $userPosts = self::where('user_id', $userId)->get()->sortByDesc('updated_at');
        return $userPosts;
    }


    public function getPostLikesCount(Post $post): int
    {
        $post = $post->likes
            ->where('likeable_id', $post->id)
            ->where('likeable_type', Post::class)
            ->where('like', true)
            ->all();
        return isset($post) ? count($post) : 0;
    }


    public function checkIfLiked(Post $post): bool
    {
        return $post->likes->where('user_id', auth()->user()->id)->first() ? true : false;
    }


    public function getLikeIcon(Post $post)
    {
        if ($post->checkIfLiked($post)) {
            $picture = '/images/svg/liked.svg';
        } else {
            $picture = '/images/svg/like.svg';
        }
        return $picture;
    }




}
