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


    public function unconfirmedFriends()  //strādā
    {
        $user = User::findOrFail(auth()->user()->id);
        $requests = $user->friends->where('accepted', 0);

        return view('friends.unconfirmed-friends', [
            'unconfirmedFriends' => $requests
        ]);
    }

    public function sendFriendRequest(int $id)  // strādā
    {
        $user = User::find($id);
        auth()->user()->friends()->create([
            'friend_id' => $user->id,
            'accepted' => 0
        ]);

        return back()->with(['message' => 'Friend request sent to ' . $user->name . ' ' . $user->surname . '!']);
    }


    public function acceptFriend(int $id)  // strādā
    {
        $request = Friend::where(['friend_id' => $id, 'user_id' => auth()->user()->id])->first();
        $request->accepted = 1;
        $request->save();

        return back();
    }


    public function unacceptFriend(int $id)  //strādā
    {
        Friend::where(['friend_id' => $id, 'user_id' => auth()->user()->id])->first()->delete();

        return back();
    }


}
