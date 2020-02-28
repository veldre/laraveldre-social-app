<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidatePhoto;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(int $albumId)
    {
        return view('photos.create', ['albumId' => $albumId]);
    }


    public function store(ValidatePhoto $request)
    {
        $fileNameWithExtension = $request->file('photo')->getClientOriginalName();  // filename with extension

        $filename = pathinfo($fileNameWithExtension, PATHINFO_FILENAME); // filename

        $extension = $request->file('photo')->getClientOriginalExtension(); //extension

        $fileNameToStore = $filename . '_' . time() . '.' . $extension;

        $request->file('photo')->storeAs('public/albums/' . $request['album-id'], $fileNameToStore);   // album-id is from hidden inputfield

        $photo = new Photo();
        $photo->album_id = $request['album-id'];
        $photo->title = $request['photo-title'];
        $photo->description = $request['photo-description'];
        $photo->size = $request->file('photo')->getSize();
        $photo->photo = $fileNameToStore;
        $photo->save();

        return redirect('/albums/' . $request['album-id'])->with(['message' => 'Photo uploaded successfully']);
    }


    public function show(int $id)
    {
        $photo = Photo::findOrFail($id);

        return view('photos.show', ['photo' => $photo]);
    }


    public function destroy(int $id)
    {
        $photo = Photo::findOrFail($id);
        if (Storage::delete('/storage/albums/' . $photo->album_id . '/' . $photo->photo)) ;

        $photo->delete();

        return redirect()->route('albums.show', $photo->album_id)->with(['message' => 'Photo deleted successfully!']);
    }
}
