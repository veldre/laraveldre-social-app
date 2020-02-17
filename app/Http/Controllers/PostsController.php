<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $ordered = Post::all()->sortByDesc('updated_at');
        return view('posts.index', [
            'posts' => $ordered,
        ]);
    }

    public function createPost(Request $request)
    {
//        dd($request);
        return view('posts.create-post');
    }

    public function storePost(Request $request)
    {
        $this->validate($request, [     // validation
            'post-title' => 'required|min:10|max:100',
            'post-text' => 'required|min:10'
        ]);
        $post = new Post();
        $post->title = $request['post-title'];
        $post->text = $request['post-text'];
        if ($request->user()->posts()->save($post)) {
            $message = 'Post was successfully created!';
        }
        return redirect()->route('posts.create-post')->with(['message' => $message]);  //redirekto kopā ar mesidžu
    }

//return back()->withInput();

    public function show(int $id)
    {
        $post = Post::where('id', $id)->first();
        $postedBy = $post->where('user_id', $post->user_id)->first()->user;
        return view('posts.show',
            ['post' => $post,
                'postedBy' => $postedBy]);

    }

    public function edit(int $id)
    {
        $post = Post::findOrFail($id);
        if (auth()->user()->id == $post->user_id) {
            return view('posts.edit-post', ['post' => $post]);
        } else {
            return redirect('home');
        }
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'post-title' => 'required|min:10|max:100',
            'post-text' => 'required|min:10'
        ]);
        $post = Post::findOrFail($id);
        $post->title = $request['post-title'];
        $post->text = $request['post-text'];
        $userPosts = $post->user->all()->where('id', $post->user_id);
//        $post->fill($request->all());
        $post->save();

        return redirect()->route('users.posts', [$post->user_id, $post->user->name, $post->user->surname])
            ->with(['userPosts' => $userPosts,
                'user' => $post->user, 'message' => 'Your post was successfully updated!']);
    }

    public function destroy(Post $post)
    {
        $userPosts = $post->user->all()->where('id', $post->user_id);
        $deletablePost = $post->where('id', $post->id)->first();
        $deletablePost->delete();

        return redirect()->route('users.posts', [$post->user_id, $post->user->name, $post->user->surname])
            ->with(['userPosts' => $userPosts,
                'user' => $post->user, 'message' => 'Your post was successfully deleted!']);
    }

    public function redirect()
    {
        return redirect()->route('users.posts', [auth()->user()->id, auth()->user()->name, auth()->user()->surname]);
    }

}
