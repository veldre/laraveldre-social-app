@extends('layouts/app', ['title' => 'Users'])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1>All users</h1>
        </div>
        <table class="table table-hover">
            <thead class="thead-dark">
            <tr class="row text-center justify-content-center">
                <th class="header col-md-2">Name</th>
                <th class="header col-md-2">Surname</th>
                <th class="header col-md-3">Activity</th>
                <th class="header col-md-3">Email</th>
                <th class="header col-md-2">Registered</th>
            </tr>
            </thead>

            <tbody>
            @foreach($users as $user)
                <tr class="row text-left justify-content-around">
                    <td class="col-md-2"><a
                            href={{route('users.show',[$user->id,$user->name,$user->surname])}}>{{$user->name}}</a></td>
                    <td class="col-md-2">{{$user->surname}}</td>
                    <td class="col-md-3 text-center align-content-center"><a
                            href={{route('users.posts',[$user->id,$user->name,$user->surname])}}>
                            <img class="mini-icon" src="/images/svg/paper-note.svg"
                                 alt="posts icon" title="Posts"> ({{$user->posts->count('post')}})</a>
                        <a href={{route('users.friends',[$user->id,$user->name,$user->surname])}}>
                            <img class="mini-icon" src="/images/fists.png"
                                 alt="friends icon" title="Friends">  ({{ $user->getFriendsCount($user)}})</a>
                        <a href={{route('users.followers',[$user->id,$user->name,$user->surname])}}>
                            <img class="mini-icon" src="/images/svg/follower.svg"
                                 alt="followers icon" title="Followers"> ({{auth()->user()->getFollowersCount($user)}})</a>
                        <a href={{route('users.followings',[$user->id,$user->name,$user->surname])}}>
                            <img class="mini-icon" src="/images/svg/following.svg"
                                 alt="followings icon" title="Following"> ({{auth()->user()->getFollowingsCount($user)}})</a></td>
                    <td class="col-md-3 text-left">{{$user->email}}</td>
                    <td class="col-md-2 text-center">{{  strftime("%d %b %Y",strtotime($user->created_at)) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-12 text-center">
                {{$users->links()}}
            </div>
        </div>
    </div>

@endsection

