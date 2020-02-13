<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

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

    public function show($id)
    {
        $user = User::findOrFail($id);
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
        $user = User::findOrFail($id);
        $userPosts = $user->find($id)->posts;
        return view('users.user-posts', [
            'userPosts' => $userPosts,
            'user' => $user
        ]);
    }
}
