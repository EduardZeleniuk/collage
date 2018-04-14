<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class UploadImage extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function allImages()
    {
        $images = [];

        $imageList = UploadImage::where('user_id', Auth::id())->latest()->get();
        foreach ($imageList as $image) {
            $img = [];
            $img['id'] = $image->id;
            $img['image'] = $image->image;
            $images[] = $img;
        }

        return $images;
    }

    public static function deletedImage($id){
        $image = UploadImage::where('id', $id)->first();
        Storage::delete('public/images/'.$image->image);
        UploadImage::where('id', $id)->delete();
    }

    public static function deletedImageAll(){
        $imageList = UploadImage::where('user_id', Auth::id())->latest()->get();
        foreach ($imageList as $image) {
            Storage::delete('public/images/'.$image->image);
            $image->delete();
        }
    }
}
