<?php

namespace App\Http\Controllers;

use App\Post;


class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $wallPostsIds = auth()->user()->getWallPostsIds();
        $posts = Post::whereIn('user_id', $wallPostsIds)->orderBy('updated_at','DESC')->paginate(5);

        return view('home', [
            'posts' => $posts
        ]);
    }

}
