<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $ordered = User::orderBy('updated_at', 'DESC')->where('id', '>', 0)->simplePaginate(10);
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
        $user = User::findOrFail($id);
        $userPosts = $user->find($id)->posts->sortByDesc('updated_at');
        return view('users.posts', [
            'userPosts' => $userPosts,
            'user' => $user
        ]);
    }
}
