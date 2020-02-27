<?php

namespace App\Http\Controllers;

use App\Friend;
use App\User;


class FriendsController extends Controller
{
    private $friendModel = null;

    public function __construct()
    {
        $this->middleware('auth');
        $this->friendModel = new Friend();
    }


    public function unconfirmedFriends()
    {
        $requests = $this->friendModel->getUnconfirmedFriends();

        return view('friends.unconfirmed-friends', [
            'unconfirmedFriends' => $requests
        ]);
    }

    public function sendFriendRequest(int $id)
    {
        $friend = User::findOrFail($id);
        $this->friendModel->sendRequest($friend);

        return back()->with(['message' => 'Friend request sent to ' . $friend->name . ' ' . $friend->surname . '!']);
    }


    public function acceptFriend(int $id)
    {
        $this->friendModel->acceptFriendRequest($id);

        return back();
    }


    public function unacceptFriend(int $id)
    {
        $this->friendModel->unacceptFriendRequest($id);

        return back();
    }

    public function unfriend(int $id)
    {
        $user = User::findOrFail($id);
        $this->friendModel->unfriendUser($id);

        return redirect()->back()->with(['message' => 'You unfriended ' . $user->name . ' ' . $user->surname . '!']);
    }


}
