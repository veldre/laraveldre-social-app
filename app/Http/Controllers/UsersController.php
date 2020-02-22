<?php

namespace App\Http\Controllers;

use App\Friend;
use App\Http\Requests\ValidateImage;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $users = User::getUsersInOrder();

        return view('users.index', [
            'users' => $users,
        ]);
    }


    public function store(Request $request)
    {
        //
    }

    public function show(User $user, int $id)
    {
        $user = $user->find($id);

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


    public function showPosts(User $user, int $id)
    {
        $user = $user->find($id);
        $userPosts = Post::getPostsByUserInOrder($id);

        return view('users.posts', [
            'userPosts' => $userPosts,
            'user' => $user
        ]);
    }

    public function addProfileImage(User $user, ValidateImage $request)
    {
        $user->find(auth()->user()->id)->update([
            'image' => $request->image->store('uploads', 'public')
        ]);

        return back()->with(['message' => 'Profile picture changed!']);
    }


}
