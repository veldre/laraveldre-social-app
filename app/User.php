<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;


    protected $guarded = [];
//    protected $fillable = [
//        'name', 'surname', 'email', 'password',
//    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('updated_at');
    }

    public function friends()
    {
        return $this->hasMany(Friend::class)->orderBy('created_at');
    }


    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'leader_id', 'user_id')
            ->withTimestamps()
            ->orderBy('created_at');
    }


    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'leader_id')
            ->withTimestamps()
            ->orderBy('created_at');
    }


    public static function getUsersInOrder()
    {
        return self::orderBy('created_at', 'DESC')->where('id', '>', 0);
    }


    public function checkIfFriends(User $user)
    {
        if (Friend::where([
                'user_id' => auth()->user()->id,
                'friend_id' => $user->id, 'accepted' => 1])->first() || Friend::where([
                'friend_id' => auth()->user()->id,
                'user_id' => $user->id, 'accepted' => 1])
                ->first()) {

            return true;
        } else {
            return false;
        }

    }


    public function checkFriendRequest(User $user)
    {
        if (Friend::where([
                'user_id' => auth()->user()->id,
                'friend_id' => $user->id])->first() || Friend::where([
                'friend_id' => auth()->user()->id,
                'user_id' => $user->id])
                ->first()) {

            return true;
        } else {
            return false;
        }
    }


    public function checkIfFollowing(User $user): bool
    {
        return (bool)Follower::where([
            'user_id' => auth()->user()->id,
            'leader_id' => $user->id])->first();
    }


    public function getFriendsCount(User $user)
    {
//        dd($user);
        return $user->friends->count();
//        $friendsCount = Friend::where(['friend_id' => $user->id, 'accepted' => 1])->count();
////            Friend::where(['user_id' => $user->id, 'accepted' => 1])->count();
//        return $friendsCount;
    }

    public function getFriendRequestsCount()
    {
        $friendRequestsCount = Friend::where(['friend_id' => auth()->user()->id, 'accepted' => 0])->count();
        return $friendRequestsCount;
    }

    public function getFollowersCount(User $user)
    {
        return $user->followers->count();
    }

    public function getFollowingsCount(User $user)
    {
        return $user->followings->count();
    }

}
