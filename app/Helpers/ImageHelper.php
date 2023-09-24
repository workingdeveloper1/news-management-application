<?php

namespace App\Helpers;

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
}
