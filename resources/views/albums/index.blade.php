@extends('layouts.app', ['title' => 'Albums'])

@section('content')
    @include('includes.message-block')

    @if (count($albums) < 1)
        <div class="row justify-content-center">
            <h1>No albums</h1>
        </div>
    @else
        <div class="row justify-content-center">
            <h1>All albums</h1>
        </div>
        <hr>
        <div class="container">
            <div class="row mt-4">
                @foreach($albums as $album)

                    <div class="card card-image mb-4 shadow-sm ml-5">
                        <img src="{{$album->getAlbumCover($album)}}" alt="album cover image" height="200px"
                             width="200px" class="album-image">
                        <div class="card-body">

                            <p class="card-text">{{$album->name}}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="{{route('albums.show', $album->id)}}" type="button"
                                       class="btn btn-sm btn-outline-secondary">View</a>
                                </div>
                                <small class="text-muted">{{$album->description}}</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection
