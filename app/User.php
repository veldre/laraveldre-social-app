<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;


    protected $fillable = [
        'name', 'surname', 'email', 'password', 'image', 'phone', 'address', 'about', 'birthday'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('updated_at', 'DESC');
    }

    public function albums()
    {
        return $this->hasMany(Album::class);
    }



    public function myFriends()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')
            ->withPivot('status')
            ->wherePivot('status', 'confirmed')
            ->orderBy('updated_at', 'DESC')
            ->withTimestamps();
    }


    public function friendOf()
    {
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id')
            ->withPivot('status')
            ->wherePivot('status', 'confirmed')
            ->orderBy('updated_at', 'DESC')
            ->withTimestamps();

    }


    public function friendRequestsToThisUser()
    {
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id')
            ->withPivot('status')
            ->wherePivot('status', 'pending')
            ->orderBy('updated_at', 'DESC')
            ->withTimestamps();
    }


    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'leader_id', 'user_id')
            ->withTimestamps()
            ->orderBy('updated_at', 'DESC');
    }


    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'leader_id')
            ->withTimestamps()
            ->orderBy('created_at', 'DESC');
    }


    public function getFollowingsIds()
    {
        return $this->followings()->allRelatedIds();
    }


    public function getFriendsIds()
    {
        $myFriendsIds = $this->myFriends()->allRelatedIds();
        $friendOfIds = $this->friendOf()->allRelatedIds();
        $friendsIds = $myFriendsIds->merge($friendOfIds);
        return $friendsIds;
    }

    public function getWallPostsIds()
    {
        return $this->getFriendsIds()->merge($this->getFollowingsIds())->merge(auth()->user()->id);
    }

    public static function getUsersInOrder()
    {
        return self::orderBy('created_at', 'DESC')->where('id', '>', 0);
    }


    public function getProfilePicture(User $user)
    {
        return Storage::url($user->image);
    }


    public function checkIfFriends(User $user)
    {
        if (Friend::where([
                'user_id' => auth()->user()->id,
                'friend_id' => $user->id, 'status' => 'confirmed'])->first() || Friend::where([
                'friend_id' => auth()->user()->id,
                'user_id' => $user->id, 'status' => 'confirmed'])
                ->first()) {

            return true;
        }
        return false;

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
        }
        return false;
    }


    public function checkUserPicture(User $user)
    {
        if ($user->image) {
            $picture = $user->getProfilePicture($user);

        } else {
            $picture = '/images/yourAd.png';
        }
        return $picture;
    }


    public function checkIfFollowing(User $user): bool
    {
        return auth()->user()->followings->contains($user->id);
    }


    public function getPostsCount(User $user): int
    {
        return $user->posts->count();
    }


    public function getFriendsCount(User $user): int
    {
        return $user->myFriends->count() + $user->friendOf->count();
    }


    public function getFriendRequestsCount(): int
    {
        return auth()->user()->friendRequestsToThisUser->count();
    }


    public function getFollowersCount(User $user): int
    {
        return $user->followers->count();
    }


    public function getFollowingsCount(User $user): int
    {
        return $user->followings->count();
    }


    public function getAlbumsCount(User $user): int
    {
        return $user->albums->count();
    }


}
