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

    public function sendFriendRequest(int $id)
    {
        $friend = User::findOrFail($id);
        $friend->friendRequestsToThisUser()->attach(auth()->user()->id, [
            'status' => 'pending'
        ]);

        return back()->with(['message' => 'Friend request sent to ' . $friend->name . ' ' . $friend->surname . '!']);
    }


    public function acceptFriend(int $id)
    {
        $request = auth()->user()->friendRequestsToThisUser()
            ->where('friend_id', auth()->user()->id)
            ->where('user_id', $id)
            ->where('status', 'pending')
            ->first();
        auth()->user()->friendRequestsToThisUser()->updateExistingPivot($request, [
            'status' => 'confirmed'
        ]);

        return back();
    }


    public function unacceptFriend(int $id)
    {
        auth()->user()->friendRequestsToThisUser()
            ->where('friend_id', auth()->user()->id)
            ->where('user_id', $id)
            ->where('status', 'pending')
            ->first()
            ->delete();

        return back();
    }

    public function unfriend(int $id)
    {
        $user = User::findOrFail($id);
        $record1 = Friend::where(['friend_id' => $id, 'user_id' => auth()->user()->id])->first();
        $record2 = Friend::where(['user_id' => $id, 'friend_id' => auth()->user()->id])->first();
        if ($record1 != null) {
            $record1->delete();
        } else {
            $record2->delete();
        }

        return redirect()->back()->with(['message' => 'You unfriended ' . $user->name . ' ' . $user->surname . '!']);
    }


}
