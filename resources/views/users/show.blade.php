@extends('layouts/app', ['title' => $user->name . ' ' . $user->surname])


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1>{{$user->name}} {{$user->surname}}</h1>
        </div>
        @include('includes.message-block')
        <div class="col-md-3 pt-4">

            {{--            <div class="form-group">--}}
            {{--                <form action={{action('FriendsController@friendsCount', [$user->id])}} method="post">--}}


            {{--                    <button type="submit" class="btn btn-info btn-sm profile-image-button">Friends Count--}}
            {{--                    </button>--}}
            {{--                </form>--}}
            {{--            </div>--}}

            @if($user->image)
                <img class="profile-image" src="{{asset('storage/'.$user->image)}}"
                     alt="profile image">
            @else
                <img class="profile-image" src="/images/yourAd.png" alt="profile image">
            @endif
            @if ($user != auth()->user())

                @if(\App\Http\Controllers\FriendsController::checkIfFriends($user->id) == false)

                    @if(\App\Http\Controllers\FriendsController::checkFriendRequest($user->id) == false)
                        <form action="{{route('friends.sendFriendRequest',[$user->id])}}" method="post">
                            <div class="form-group">
                                <button type="submit" class="btn btn-info btn-sm profile-image-button">Send friend
                                    request
                                </button>
                            </div>
                        </form>
                    @else
                        <button class="btn btn-info btn-sm profile-image-button" disabled="disabled">
                            Friend request sent
                        </button>
                    @endif
                @else
                    <form action="" method="post">
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-sm profile-image-button">Unfriend
                            </button>
                        </div>
                    </form>
                @endif
            @endif
        </div>
        <ul class="col-md-3 pt-2">
            <div class="user-data">
                <label for="name">Name:</label>
                <li id="name">{{ $user->name }}</li>
            </div>
            <div class="user-data">
                <label for="surname">Surname:</label>
                <li id="name">{{ $user->surname }}</li>
            </div>
            <div class="user-data">
                <label for="email">Email:</label>
                <li id="email">{{ $user->email }}</li>
            </div>
            <div class="user-data">
                <label for="registered-at">Registered:</label>
                <li id="registered-at">{{  strftime("%d %b %Y",strtotime($user->created_at)) }}</li>
            </div>
            <div class="user-data">
                <label for="posts-count">Posts count:</label>
                <li id="posts-count">{{  $user->posts->count() }}</li>
            </div>
            <div class="user-data">
                <label for="posts-count">Friends count:</label>
                <li id="friends-count">{{ App\Http\Controllers\FriendsController::friendsCount($user->id) }}</li>
            </div>
            <a href="{{route('users.posts',[$user,$user->name,$user->surname])}}"
               class="btn btn-success btn-md btn-block">Show
                all posts by {{$user->name}}</a>
        </ul>
    </div>


@endsection
