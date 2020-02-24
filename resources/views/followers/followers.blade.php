@extends('layouts/app', ['title' => 'My followers'])


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if (auth()->user()->id == $user->id)
                <h1>My Followers</h1>
            @else
                <h1>{{$user->name}} {{$user->surname}} followers</h1>
            @endif
        </div>
        @include('includes.message-block')
        <table class="table table-hover">
            <thead class="thead-dark">
            <tr class="row text-center justify-content-center">
                <th class="header col-md-4">Name</th>
                <th class="header col-md-4">Surname</th>
                <th class="header col-md-4">Follower since</th>
            </tr>
            </thead>

            <tbody>
            @foreach($followers as $follower)

                <tr class="row text-center justify-content-center">
                    <td class="col-md-4">
                        <a href={{route('users.show',[$follower->user->id,$follower->user->name,$follower->user->surname])}}>{{$follower->user->name}}</a>
                    </td>
                    <td class="col-md-4">{{$follower->user->surname}}</td>
                    <td class="col-md-4">{{ strftime("%d %b %Y",strtotime($follower->user->created_at))}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-12 text-center">
                {{$followers->links()}}
            </div>
        </div>
    </div>

@endsection
