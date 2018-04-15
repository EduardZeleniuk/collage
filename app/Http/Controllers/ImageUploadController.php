<?php

namespace App\Http\Controllers;

use App\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\UploadImage;
use App\Collage;
use Image;

class ImageUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function imageUpload()
    {
        $images = UploadImage::allImages();
        $layouts = Layout::allImages();
        $collages = Collage::allCollages();

        $isSavedCollages = Collage::where('is_saved', 0)->get();

        if($isSavedCollages) {
            $isSavedCollages = $isSavedCollages;
        } else {
            $isSavedCollages = '';
        }

        return view('pages.imageUpload', ['images' => $images, 'layouts' => $layouts, 'collages' => $collages, 'isSavedCollages' => $isSavedCollages]);
    }

    public function imageUploadPost(Request $request)
    {
        $this->validate($request,[
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if(count($request->images) > 10)
            return back()->withInput()->withErrors('Можно загрузить за раз до 10 фото');

        foreach ($request->images as $image) {
            $imageName = $image->store('public/images');
            $imageName = substr($imageName, strripos($imageName, '/') + 1);

            $image = new UploadImage;
            $image->user_id = Auth::id();
            $image->image = $imageName;
            $image->save();
        };

        return back();

    }

    public function imageDelete($id)
    {
        UploadImage::deletedImage($id);

        return back();
    }

    public function imageDeleteAll()
    {
        UploadImage::deletedImageAll();

        return back();
    }

    public function collageCreate(Request $request, $image, $layout, $pos)
    {
        if(!file_exists(storage_path('app/public/images/layouts/'. $layout .'.png')) AND !file_exists(storage_path('app/public/images/'. $image)))
        {
            abort(404);
        }

        $layout1 = [
            '1' => [
                'height' => 625,
                'width'  => 625,
                'posX'   => 50,
                'posY'   => 50
            ],
            '2' => [
                'height' => 625,
                'width'  => 625,
                'posX'   => 725,
                'posY'   => 50
            ],
            '3' => [
                'height' => 625,
                'width'  => 625,
                'posX'   => 725,
                'posY'   => 725
            ],
            '4' => [
                'height' => 625,
                'width'  => 625,
                'posX'   => 50,
                'posY'   => 725
            ]
        ];
        $layout2 = [
            '1' => [
                'height' => 625,
                'width'  => 625,
                'posX'   => 50,
                'posY'   => 50
            ],
            '2' => [
                'height' => 625,
                'width'  => 625,
                'posX'   => 50,
                'posY'   => 725
            ],
            '3' => [
                'height' => 1300,
                'width'  => 625,
                'posX'   => 725,
                'posY'   => 50
            ]
        ];
        $layout3 = [
            '1' => [
                'height' => 625,
                'width'  => 625,
                'posX'   => 50,
                'posY'   => 50
            ],
            '2' => [
                'height' => 625,
                'width'  => 625,
                'posX'   => 725,
                'posY'   => 50
            ],
            '3' => [
                'height' => 625,
                'width'  => 1300,
                'posX'   => 50,
                'posY'   => 725
            ]
        ];

        if($layout == 'layout1')
            $layoutName = $layout1;
        elseif($layout == 'layout2')
            $layoutName = $layout2;
        elseif($layout == 'layout3')
            $layoutName = $layout3;

        $layoutsWidth  = $layoutName[$pos]['width'];
        $layoutsHeight = $layoutName[$pos]['height'];
        $layoutsPosX = $layoutName[$pos]['posX'];
        $layoutsPosY = $layoutName[$pos]['posY'];

        $layoutId = Layout::where('image', $layout)->first()->id;
        $isSaved = Collage::where('is_saved', 0)->where('layout_id', $layoutId)->first();

        if($isSaved) {
            $collageName =  $isSaved->collage;
            $collagePath = storage_path('app/public/images/collage/'. $isSaved->collage .'.jpeg');
        } else {
            $collageName = str_random(20);
            $collagePath = storage_path('app/public/images/layouts/'. $layout .'.png');
        }


        $collage = Image::make($collagePath);
        $img = Image::make(storage_path('app/public/images/'. $image));
        $img->fit($layoutsWidth, $layoutsHeight);
        $collage->insert($img, 'top-left', $layoutsPosX, $layoutsPosY);

        $collage->save(storage_path('app/public/images/collage/'. $collageName .'.jpeg'));


        if(!$isSaved) {
            $collageDb = new Collage;
            $collageDb->user_id = Auth::id();
            $collageDb->layout_id = $layoutId;
            $collageDb->collage = $collageName;
            $collageDb->save();
        }

        return back();
    }

    public function collageSave($collageId)
    {
        $collageDb = Collage::where('id', $collageId)->first();
        if(empty($collageDb))
            return back()->with('errors', 'Ошибка при сохренении');

        $collageDb->is_saved = 1;
        $collageDb->save();

        return back()->with('success', 'Сохранено');
    }
}
