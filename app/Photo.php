<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function getPhoto(Photo $photo)
    {
        return Storage::url('albums/' . $photo->album->id . '/' . $photo->photo);
    }
}
