<?php

namespace App\Http\Controllers;

use App\Album;
use App\Http\Requests\ValidateAlbum;

class AlbumsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $albums = Album::with('photos')->get();
        return view('albums.index', ['albums' => $albums]);
    }


    public function create()
    {
        return view('albums.create');
    }


    public function store(ValidateAlbum $request)
    {
        $fileNameWithExtension = $request->file('cover-image')->getClientOriginalName();  // filename with extension

        $filename = pathinfo($fileNameWithExtension, PATHINFO_FILENAME); // filename

        $extension = $request->file('cover-image')->getClientOriginalExtension(); //extension

        $fileNameToStore = $filename . '_' . time() . '.' . $extension;

        $request->file('cover-image')->storeAs('public/album_covers', $fileNameToStore);

        $album = new Album();
        $album->user_id = auth()->user()->id;
        $album->name = $request['album-name'];
        $album->description = $request['album-description'];
        $album->cover_image = $fileNameToStore;
        $album->save();

        return back()->with(['message' => 'Album uploaded successfully']);
    }


    public function show(int $id)
    {
        $album = Album::with('photos')->findOrFail($id);

        return view('albums.show',['album' => $album]);
    }
}
