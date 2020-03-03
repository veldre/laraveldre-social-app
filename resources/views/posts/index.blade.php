@extends('layouts/app', ['title' => 'Posts'])

@section('content')
    @include('includes.message-block')
    <div class="container">
        <div class="row justify-content-center">
            <h1>Latest posts</h1>
        </div>
        <table class="table table-hover">
            <thead class="thead-dark">

            <tr class="row text-center justify-content-center">
                <th class="header col-md-2">Posted by</th>
                <th class="header col-md-3">Title</th>
                <th class="header col-md-5">Text</th>
                <th class="header col-md-2">Posted at</th>
            </tr>
            </thead>

            <tbody>
            @foreach($posts as $post)

                <tr class="row text-center justify-content-center">
                    <td class="col-md-2"><a
                            href={{route('users.posts',[$post->user_id,$post->user->name,$post->user->surname])}}>
                            {{$post->user->name}} {{$post->user->surname}}
                            <img class="small-profile-image"
                                 src="{{$post->user->checkUserPicture($post->user)}}"></a>
                    </td>
                    <td class="col-md-3 text-left"><a
                            href={{route('posts.show',[$post->id,$post->title])}}>{{$post->title}}</a></td>
                    <td class="col-md-5 text-left"><p>{!!Str::limit($post->text, $limit = 200, $end = '...')!!}
                            <a href="{{route('posts.show',[$post->id,$post->title])}}"
                               class="stretched-link">read more</a></p></td>
                    <td class="col-md-2">{{  strftime("%d %b %Y %H:%M",strtotime($post->updated_at)) }}
                        <a href={{route('posts.like',[$post->id])}}> <img class="w-25 mt-3"
                                                                          src="{{$post->getLikeIcon($post)}}"
                                                                          alt="like icon" title="Like"></a><br>
                        ({{$post->getPostLikesCount($post)}})
                        <p>{{auth()->user()->checkIfLiked($post)}}</p>


                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-12 text-center">
                {{$posts->links()}}
            </div>
        </div>
    </div>

@endsection

