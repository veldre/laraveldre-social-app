<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidatePost;
use App\Post;


class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::getPostsInOrder();
        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function createPost()
    {
        return view('posts.create');
    }

    public function storePost(ValidatePost $request)
    {
        auth()->user()->posts()->create([
            'title' => $request['post-title'],
            'text' => $request['post-text']
        ]);

        return redirect()->route('posts.create')->with(['message' => 'Post was successfully created!']);
    }

    public function show(Post $post, int $id)
    {
        $post = $post->findOrFail($id);
        return view('posts.show', ['post' => $post]);
    }

    public function edit(Post $post, int $id)
    {
        $post = $post->findOrFail($id);
        if (auth()->user()->id === $post->user_id) {
            return view('posts.edit', ['post' => $post]);
        }

        return redirect('home');
    }

    public function update(Post $post, ValidatePost $request, int $id)
    {
        $post = $post->findOrFail($id);
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
