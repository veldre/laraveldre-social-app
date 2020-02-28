@extends('layouts.app', ['title' => 'Albums'])

@section('content')
    @include('includes.message-block')

    <section class="container text-center">
        <h1>{{$photo->title}}</h1>
        <p class="lead text-muted">{{$photo->description}}</p>
        <div class="d-inline-flex">
            <a href="{{route('albums.show',[$photo->album->id])}}" class="btn btn-primary">Back</a>
        <form action="{{route('photos.destroy',$photo->id)}}" method="post" onclick="return confirm('Are you sure?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-secondary ml-2">Delete</button>
        </form>
        </div>
        <hr>
        <img src="{{$photo->getPhoto($photo)}}" alt="{{$photo->title}}" width="1000px">
    </section>

@endsection
