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


    public function unconfirmedFriends()
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
        $requester = User::findOrfail($id);
        $friend->acceptFriendRequest($id);

        return back()->with(['message' => 'You are now friends with ' . $requester->name . ' ' . $requester->surname . '!']);;
    }


    public function unacceptFriend(Friend $friend, int $id)
    {
        $requester = User::findOrfail($id);
        $friend->unacceptFriendRequest($id);

        return back()->with(['message' => 'Friendship request from ' . $requester->name . ' ' . $requester->surname . ' has been deleted!']);;
    }

    public function unfriend(Friend $friend, int $id)
    {
        $unfriendableUser = User::findOrFail($id);
        $unfriendableUser->followers()->detach(auth()->user()->id);
        $friend->unfriendUser($id);

        return redirect()->back()->with(['message' => 'You unfriended ' . $unfriendableUser->name . ' ' . $unfriendableUser->surname . '!']);
    }


}
