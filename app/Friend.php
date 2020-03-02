<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{

    protected $fillable = ['friend_id', 'accepted'];

    public function user()
    {
        return $this->belongsTo(User::class, 'friend_id');
    }

    public function getUnconfirmedFriends()
    {
        $requests = auth()->user()->friendRequestsToThisUser()
            ->where('friend_id', auth()->user()->id)
            ->where('status', 'pending')
            ->get();

        return $requests;
    }


    public function sendRequest(User $user): void
    {
        $user->friendRequestsToThisUser()->attach(auth()->user()->id, [
            'status' => 'pending'
        ]);
    }


    public function acceptFriendRequest(int $id): void
    {
        $request = auth()->user()->friendRequestsToThisUser()
            ->where('friend_id', auth()->user()->id)
            ->where('user_id', $id)
            ->where('status', 'pending')
            ->first();
        auth()->user()->friendRequestsToThisUser()->updateExistingPivot($request, [
            'status' => 'confirmed'
        ]);

    }


    public function unacceptFriendRequest(int $id): void
    {
        auth()->user()->friendRequestsToThisUser()
            ->where('friend_id', auth()->user()->id)
            ->where('user_id', $id)
            ->where('status', 'pending')
            ->first()
            ->delete();
    }


    public function unfriendUser(int $id): void
    {
        $record1 = self::where(['friend_id' => $id, 'user_id' => auth()->user()->id])->first();
        $record2 = self::where(['user_id' => $id, 'friend_id' => auth()->user()->id])->first();
        if ($record1 != null) {
            $record1->delete();
        } else {
            $record2->delete();
        }
    }

}
