<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateImage;
use App\Post;
use App\User;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $users = User::getUsersInOrder()->paginate(10);

        return view('users.index', [
            'users' => $users,
        ]);
    }


    public function show(int $id)
    {
        $user = User::findOrFail($id);
        $followingsIds = $user->getFollowingsIds();
        $posts = Post::whereIn('user_id', $followingsIds)->paginate(5);
        if ($user != auth()->user()) {
            return view('users.show', [
                'user' => $user,
                'posts' => $posts
            ]);
//                'picture' => $user->checkUserPicture($user)]);
        }
        return redirect('home');
    }


    public function showPosts(int $id)
    {
        $user = User::findOrFail($id);
        $userPosts = Post::getPostsByUserInOrder($id);

        return view('users.posts', [
            'userPosts' => $userPosts,
            'user' => $user
        ]);
    }

    public function showFriends(int $id)
    {
        $user = User::findOrFail($id);
        $friends1 = $user->friendOf;
        $friends2 = $user->myFriends;
        $friends = $friends1->merge($friends2);

        return view('friends.friends', [
            'friends' => $friends,
            'user' => $user
        ]);
    }


    public function showFollowers(int $id)
    {
        $user = User::findOrFail($id);
        $followers = $user->followers;

        return view('followers.followers', [
            'user' => $user,
            'followers' => $followers
        ]);
    }

    public function showFollowings(int $id)
    {
        $user = User::findOrFail($id);
        $followings = $user->followings;

        return view('followers.followings', [
            'user' => $user,
            'followings' => $followings
        ]);
    }


    public function followUser(int $id)
    {
        $user = User::findOrFail($id);
        $user->followers()->attach(auth()->user()->id);

        return back()->with(['message' => 'You now follow ' . $user->name . ' ' . $user->surname . '!']);
    }


    public function unFollowUser(int $id)
    {
        $user = User::findOrFail($id);
        $user->followers()->detach(auth()->user()->id);

        return redirect()->back()->with(['message' => 'You unfollowed ' . $user->name . ' ' . $user->surname . '!']);
    }


    public function addProfileImage(ValidateImage $request)
    {
        auth()->user()->update([
            'image' => $request->image->store('avatars', 'public')
        ]);

        return back()->with(['message' => 'Profile picture changed!']);
    }


}
