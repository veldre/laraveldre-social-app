<?php

namespace App\Http\Controllers;

use App\Follower;
use App\Following;
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
        $users = User::getUsersInOrder()->simplePaginate(10);

        return view('users.index', [
            'users' => $users,
        ]);
    }


    public function show(int $id)
    {
        $user = User::findOrFail($id);
        if ($user != auth()->user()) {
            return view('users.show', ['user' => $user]);
//                'picture' => $this->checkUserPicture($user)]);
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
        $friends = Friend::getFriendsInOrder($id);

        return view('friends.friends', [
            'friends' => $friends,
            'user' => $user
        ]);
    }


    public function showFollowers(int $id)  //strādā
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


    public function followUser(int $id)  //strādā
    {
        $user = User::findOrFail($id);
        $user->followers()->attach(auth()->user()->id);

        return back()->with(['message' => 'You now follow ' . $user->name . ' ' . $user->surname . '!']);
    }


    public function unFollowUser(int $id)  //strādā
    {
        $user = User::findOrFail($id);
        $user->followers()->detach(auth()->user()->id);

        return redirect()->back()->with(['message' => 'You unfollowed ' . $user->name . ' ' . $user->surname . '!']);
    }

    public function unfriendUser(int $id)
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


    public function addProfileImage(User $user, ValidateImage $request)
    {
        $user->findOrFail(auth()->user()->id)->update([
            'image' => $request->image->store('uploads', 'public')
        ]);

        return back()->with(['message' => 'Profile picture changed!']);
    }


//    public function checkUserPicture(User $user)
//    {
//        if ($user->image) {
//            $picture = '<img class="profile-image" src="{{asset(\'storage/\'.$user->image)}}"
//                     alt="profile image">';
//        } else {
//            $picture = '<img class="profile-image" src="/images/yourAd.png" alt="profile image">';
//        }
//        return $picture;
//    }

}
