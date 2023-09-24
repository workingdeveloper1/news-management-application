<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ImageHelper{
    public static function uploadImage($request){
        if($file = $request->hasFile('image')) {
            $file = $request->file('image') ;
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'/News/Image';
            $time = time();
            $file->move($destinationPath,$time . $fileName);
            return "/News/Image/" . $time . $fileName;
        }else {
            return "";
        }
    }

    public static function deleteImage($newsImage) {
        if (File::exists(public_path() . $newsImage)) {
            File::delete(public_path() . $newsImage);
        }
    }
}
