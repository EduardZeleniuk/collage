<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{
    public static function allImages()
    {
        $layoutsList = [];

        $layouts = Layout::all();
        foreach ($layouts as $layout) {
            $data = [];
            $data['id'] = $layout->id;
            $data['pos'] = $layout->positions;
            $data['image'] = $layout->image;
            $layoutsList[]= $data;
        }

        return $layoutsList;
    }
}
