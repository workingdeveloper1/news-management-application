<?php

namespace App\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidatorHelper{
    public static function makeNewsValidator(Request $request){
        return Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'image' => 'required'
        ]);
    }

    public static function makeCommentValidator(Request $request){
        return Validator::make($request->all(), [
            'comment' => 'required',
        ]);
    }

    public static function makeLoginValidator(Request $request){
        return Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
    }

    public static function makeRegisterValidator(Request $request){
        return Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
    }

}
