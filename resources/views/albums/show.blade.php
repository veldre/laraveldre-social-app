@extends('layouts.app', ['title' => 'Album: ' . $album->name])

@section('content')
    @include('includes.message-block')

    <section class="container text-center">
        <h1>{{$album->name}}</h1>
        <p class="lead text-muted">{{$album->description}}</p>
        <p>
            <a href="{{route('photos.create',[$album->id])}}" class="btn btn-primary">Upload photo</a>
            <a href="/albums" class="btn btn-secondary ml-2">Back</a>
        </p>
    </section>

    <div class="container-flex p-3 justify-content-center">
        <div class="row mt-4 pl-5 pr-5">
            @foreach($album->photos as $photo)

                <div class="card card-image mb-4 shadow-sm ml-5">
                    <img src="{{$photo->getPhoto($photo)}}" alt="album cover image" height="200px"
                         width="200px" class="album-image">
                    <div class="card-body">

                        <p class="card-text">{{$photo->title}}</p>
                        <div class="d-block
                         justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="{{route('photos.show', $photo->id)}}" type="button"
                                   class="btn btn-sm btn-outline-secondary">View</a>
                            </div>
                            <small class="text-muted px-2">{{$photo->description}}</small>
                                                  <small class="text-muted">Uploaded
                                by: {{$photo->album->user->name}} {{$photo->album->user->surname}}</small>
                                     </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
