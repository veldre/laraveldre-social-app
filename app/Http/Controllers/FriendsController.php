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


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Friend $friend
     * @return \Illuminate\Http\Response
     */
    public static function show(Friend $friend)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Friend $friend
     * @return \Illuminate\Http\Response
     */
    public function edit(Friend $friend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Friend $friend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Friend $friend)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Friend $friend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Friend $friend)
    {
        //
    }


}