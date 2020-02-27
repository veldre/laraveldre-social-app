<?php

namespace App\Http\Controllers;

use App\Friend;
use App\User;


class FriendsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function unconfirmedFriends()  // ies uz user controller
    {
        $requests = auth()->user()->friendRequestsToThisUser()
            ->where('friend_id', auth()->user()->id)
            ->where('status', 'pending')
            ->get();

        return view('friends.unconfirmed-friends', [
            'unconfirmedFriends' => $requests
        ]);
    }

    public function sendFriendRequest(Friend $friend, int $id)
    {
        $user = User::findOrFail($id);
        $friend->sendRequest($user);

        return back()->with(['message' => 'Friend request sent to ' . $user->name . ' ' . $user->surname . '!']);
    }


    public function acceptFriend(Friend $friend, int $id)
    {
        $friend->acceptFriendRequest($id);

        return back();
    }


    public function unacceptFriend(Friend $friend, int $id)
    {
        $friend->unacceptFriendRequest($id);

        return back();
    }

    public function unfriend(Friend $friend, int $id)
    {
        $user = User::findOrFail($id);
        $friend->unfriendUser($id);

        return redirect()->back()->with(['message' => 'You unfriended ' . $user->name . ' ' . $user->surname . '!']);
    }


}
