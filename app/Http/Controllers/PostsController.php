<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidatePost;
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
        $posts = Post::getPostsInOrder()->simplePaginate(10);;
        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function createPost()
    {
        return view('posts.create-post');
    }

    public function storePost(ValidatePost $request)
    {
        $post = new Post();
        $post->title = $request['post-title'];
        $post->text = $request['post-text'];
        auth()->user()->posts()->save($post);

        return redirect()->route('posts.create-post')->with(['message' => 'Post was successfully created!']);
    }

    public function show(Post $post, int $id)
    {
        $post = $post->find($id);
        return view('posts.show', ['post' => $post]);
    }

    public function edit(Post $post, int $id)
    {
        $post = $post->find($id);
        if (auth()->user()->id == $post->user_id) {
            return view('posts.edit-post', ['post' => $post]);
        } else {
            return redirect('home');
        }
    }

    public function update(Post $post, ValidatePost $request, int $id)
    {
        $post = $post->find($id);
        $post->fill(['title' => $request['post-title'], 'text' => $request['post-text']]);
        $post->save();

        return redirect()->route('users.posts', [$post->user_id, $post->user->name, $post->user->surname])
            ->with(['user' => $post->user, 'message' => 'Your post was successfully updated!']);
    }

    public function destroy(Post $post)
    {
        if (auth()->user()->id == $post->user_id) {
            $deletablePost = $post->where('id', $post->id)->first();
            $deletablePost->delete();
        }
        return redirect()->route('users.posts', [$post->user_id, $post->user->name, $post->user->surname])
            ->with(['user' => $post->user, 'message' => 'Your post was successfully deleted!']);
    }
}
