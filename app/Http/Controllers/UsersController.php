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
        $singleUser = User::findOrFail($user);
        return view('users.show', ['user' => $singleUser]);
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
        $user = User::findOrFail($id);
        $userPosts = $user->find($id)->posts;
        return view('users.user-posts', [
            'userPosts' => $userPosts,
            'user' => $user
        ]);
    }
}
