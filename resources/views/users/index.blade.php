@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1>All users</h1>
        </div>
        <table class="table table-hover">
            <thead class="thead-dark">
            <tr class="row text-center justify-content-center">
                <th class="header col-md-3">Name</th>
                <th class="header col-md-3">Surname</th>
                <th class="header col-md-2">Activity</th>
                <th class="header col-md-2">Email</th>
                <th class="header col-md-2">Registered</th>
            </tr>
            </thead>

            <tbody>
            @foreach($users as $user)
                <tr class="row text-center justify-content-center">
                    <td class="col-md-3"><a href={{route('users.show',[$user,$user->name,$user->surname])}}>{{$user->name}}</a></td>
                    <td class="col-md-3">{{$user->surname}}</td>
                    <td class="col-md-2"> <a href={{route('users.posts',[$user->id,$user->name,$user->surname])}}>
                            <img id="posts-icon" src="/images/svg/paper-note.svg" alt="posts_icon">({{$user->posts->count('post')}})</a></td>
                    <td class="col-md-2 text-left">{{$user->email}}</td>
                    <td class="col-md-2">{{  strftime("%d %b %Y",strtotime($user->created_at)) }}</td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>

@endsection

