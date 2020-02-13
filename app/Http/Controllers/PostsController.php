<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $ordered = Post::all()->sortByDesc('updated_at');
        return view('posts.index', [
            'posts' => $ordered,
        ]);
    }

    public function createPost()
    {
        return view('posts.create-post');
    }

    public function storePost(Request $request)
    {
        $post = new Post();
        $post->title = $request['post-title'];
        $post->text = $request['post-text'];
        $request->user()->posts()->save($post);
        return redirect()->route('posts.index');
    }

    public function show(Post $id)
    {
        $post = Post::findOrFail($id);
        $postedBy = $post->find($id)->user;

        return view('posts.show',
            ['post' => $post,
                'postedBy' => $postedBy]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Post $post
     * @return Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return Response
     */
    public function destroy(Post $post)
    {
        //
    }


}
