<?php

namespace App\Helpers;

class ResponseFormatter{
    protected static $response = [
        'meta' => [
            'code' => 200,
            'status' => 'success',
            'message' => null
        ],
        'data' => null,
        'errors' => null
    ];

    public static function success($data = null, $message=null, $code=200, $status='success'){
        self::$response['meta']['message'] = $message;
        self::$response['meta']['code'] = $code;
        self::$response['meta']['status'] = $status;
        self::$response['data'] = $data;
        self::$response['errors'] = null;

        return response()->json(self::$response, self::$response['meta']['code']);
    }

    public static function error($data = null, $message = null, $code = 400, $errors)
    {
        self::$response['meta']['status'] = 'error';
        self::$response['meta']['code'] = $code;
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;
        self::$response['errors'] = $errors;

        return response()->json(self::$response, self::$response['meta']['code']);
    }
}
