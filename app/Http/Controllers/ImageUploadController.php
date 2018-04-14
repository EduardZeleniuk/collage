<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\UploadImage;

class ImageUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function imageUpload()
    {
//        $base = Image::make(storage_path('app/public/blog/Aa08TWeThAUukvmUUSlMWjJmai2NmwiOY0sHykuh.jpeg'));
//        $base2= Image::make(storage_path('app/public/blog/etzOSop2asNUEgKzIj98fpr0ZMhjYPj2VJgMPVcF.jpeg'));
//        var_dump($base);
//        $base->insert($base2, 'bottom-right', 10, 10);
//        $base->save(storage_path('app/public/blog/Aa08TWeThAUukvmUUSlMWjJmai2NmwiOY0sHykuh.jpeg'));

        $images = UploadImage::allImages();
        return view('pages.imageUpload', ['images' => $images]);
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

    public function collage()
    {
        $base = Image::make(storage_path('app/public/blog/9ssLY0erbCajkd7TBW7eT3Nn8ISgLaVyhQwpj46N.jpeg'));
        $base2= Image::make(storage_path('app/public/blog/DQBGhgqLN5YovXItSJBW3FYiUSudCfqF40wWMM5s.jpeg'));
        var_dump($base);
        $base->insert($base2, 'bottom-right', 10, 10);
        $base->save(storage_path('app/public/blog/9ssLY0erbCajkd7TBW7eT3Nn8ISgLaVyhQwpj46N.jpeg'));
    }
}
