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

        $collageList = Collage::where('user_id', Auth::id())->latest()->get();
        foreach ($collageList as $collage) {
            $img = [];
            $img['id'] = $collage->id;
            $img['layout_id'] = $collage->layout_id;
            $img['image'] = $collage->collage;
            $img['isSaved'] = $collage->is_saved;
            $collages[] = $img;
        }

        return $collages;
    }
}
