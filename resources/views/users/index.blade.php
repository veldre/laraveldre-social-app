@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1>All users</h1>
        </div>
        <table class="table table-hover">
            <thead class="thead-dark">

            <tr class="row text-center">
                <th class="header-left poster">Name</th>
                <th class="header title">Surname</th>
                <th class="header title">Email</th>
                <th class="header title">Registered</th>
            </tr>

            </thead>

            <tbody>
            @foreach($users as $user)
                <tr class="row text-center">
                    <td class="poster"><a href="/users/{{$user->id}}/show">{{$user->name}}</a></td>
                    <td class="title">{{$user->surname}}</td>
                    <td class="title">{{$user->email}}</td>
                    <td class="title">{{  strftime("%d %b %Y",strtotime($user->created_at)) }}</td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>

@endsection

