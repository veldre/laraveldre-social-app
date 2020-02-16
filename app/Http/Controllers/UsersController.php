<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $ordered = User::all()->sortByDesc('updated_at');
        return view('users.index', [
            'users' => $ordered,
        ]);
    }


    public function store(Request $request)
    {
        //
    }

    public function show($user)
    {
        $user = User::where('id', $user)->first();
        return view('users.show', ['user' => $user]);
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }


    public function showPosts($id)
    {
//        dd($id);
        $user = User::findOrFail($id);
//        dd($user);
        $userPosts = $user->find($id)->posts;
//        dd($userPosts);
        return view('users.posts', [
            'userPosts' => $userPosts,
            'user' => $user
        ]);
    }
}
