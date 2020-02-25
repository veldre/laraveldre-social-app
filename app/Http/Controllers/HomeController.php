<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $followingsIds = auth()->user()->getFollowingsIds();
        $posts = Post::whereIn('user_id', $followingsIds)->paginate(5);

        return view('home', [
            'posts' => $posts
        ]);
    }

}
