<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class Collage extends Model
{
    public static function allCollages()
    {
        $collages = [];

        $collageList = Collage::where('user_id', Auth::id())->where('is_saved', 1)->latest()->get();
        foreach ($collageList as $collage) {
            $img = [];
            $img['id'] = $collage->id;
            $img['layout_id'] = $collage->layout_id;
            $img['collage'] = $collage->collage;
            $img['isSaved'] = $collage->is_saved;
            $collages[] = $img;
        }

        return $collages;
    }

    public static function deletedCollage($id){
        $collage = Collage::where('id', $id)->first();
        if($collage->user_id != Auth::id())
            abort('404');

        Storage::delete('public/images/collage/'.$collage->collage.'.jpeg');
        Collage::where('id', $id)->delete();
    }

    public static function deletedCollageAll(){
        $collageList = Collage::where('user_id', Auth::id())->latest()->get();
        foreach ($collageList as $collage) {
            Storage::delete('public/images/collage'.$collage->image.'.jpeg');
            $collage->delete();
        }
    }
}
