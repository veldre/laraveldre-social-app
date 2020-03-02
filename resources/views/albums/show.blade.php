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
    <hr>
    <div class="container">
        <div class="row mt-4">
            @foreach($album->photos as $photo)

                <div class="card card-image mb-4 shadow-sm ml-5">
                    <img src="{{$photo->getPhoto($photo)}}" alt="album cover image" height="200px"
                         width="200px" class="album-image">
                    <div class="card-body">

                        <p class="card-text">{{$photo->title}}</p>
                        <div class="d-flex
                         justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="{{route('photos.show', $photo->id)}}" type="button"
                                   class="btn btn-sm btn-outline-secondary">View</a>
                            </div>
                            @if($photo->album->user ==auth()->user())
                                <form class="btn-group" method="post"
                                      action="{{route('photos.destroy', $photo->id)}}">
                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                            class="btn btn-sm btn-outline-secondary">Delete
                                    </button>
                                    @method('DELETE')
                                </form>
                            @endif
                        </div>
                        <small class="text-muted">{{$photo->description}}</small><br>
                        <small class="text-muted">Uploaded: <br>{{$photo->updated_at}}</small>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
