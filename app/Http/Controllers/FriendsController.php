<?php

namespace App\Http\Controllers;

use App\Friend;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function unconfirmedFriends()
    {
        $requests = Friend::getUnconfirmedFriendsInOrder()->simplePaginate(10);

        return view('friends.unconfirmed-friends', [
            'unconfirmedFriends' => $requests
        ]);
    }

    public function sendFriendRequest(int $id)
    {
        $user = User::find($id);
        auth()->user()->friends()->create([
            'friend_id' => $user->id,
            'accepted' => 0
        ]);

        return back()->with(['message' => 'Friend request sent to ' . $user->name . ' ' . $user->surname . '!']);
    }


    public function acceptFriend(Friend $friend, int $id)
    {
        $friendRequest = $friend->getFriendRequest($id);
        $friendRequest->accepted = 1;
        $friendRequest->save();

        return back();
    }


    public function unacceptFriend(Friend $friend, int $id)
    {
        $friend->getFriendRequest($id)->delete();

        return back();
    }


}
