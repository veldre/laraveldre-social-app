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

    public function index()
    {
    }

    public function unconfirmedFriends()
    {
        $requests = Friend::getUnconfirmedFriendsInOrder()->simplePaginate(10);

        return view('friends.unconfirmed-friends', [
            'unconfirmedFriends' => $requests
        ]);
    }

    public function sendFriendRequest(User $user, int $id)
    {
        $user = $user->find($id);
        $user_id = auth()->user()->id;
        $friend_id = $user->id;
        $friend = new Friend();
        $friend->user_id = $user_id;
        $friend->friend_id = $friend_id;
        $friend->save();

        return back()->with(['message' => 'Friend request sent to ' . $user->name . '!']);
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
