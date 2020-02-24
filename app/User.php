<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded = [];
//    protected $fillable = [
//        'name', 'surname', 'email', 'password',
//    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function friends()
    {
        return $this->hasMany(Friend::class);
    }


    public function followers()
    {
        return $this->hasMany(Follower::class);
    }


    public function followings()
    {
        return $this->hasMany(Following::class);
    }


    public static function getUsersInOrder()
    {
        $posts = self::orderBy('created_at', 'DESC')->where('id', '>', 0);
        return $posts;
    }

    public function checkIfFriends(User $user)
    {
        $friendStatus = self::checkFriendRequest($user);
        if ($friendStatus['accepted'] != 0) {
            return true;
        }
    }

    public function checkFriendRequest(User $user)
    {
        $friendshipRequest = Friend::where([
            'user_id' => auth()->user()->id,
            'friend_id' => $user->id])->first();

        return $friendshipRequest;
    }

    public function getFriendsCount(User $user)
    {
        $friendsCount = Friend::where(['friend_id' => $user->id, 'accepted' => 1])->count();
        return $friendsCount;
    }

    public function getFriendRequestsCount()
    {
        $friendRequestsCount = Friend::where(['friend_id' => auth()->user()->id, 'accepted' => 0])->count();
        return $friendRequestsCount;
    }

    public function getFollowersCount(User $user)
    {
        $followersCount = Follower::where('leader_id',$user->id)->count();
        return $followersCount;
    }

    public function getFollowingsCount(User $user)
    {
        $followingsCount = Following::where('follower_id', $user->id)->count();
        return $followingsCount;
    }


}
