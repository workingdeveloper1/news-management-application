<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AuthHelper{
    public static function createToken($user)  {
        $resultToken = $user->createToken('OAuth Access Token');
        $token = $resultToken->token;
        $token->expires_at = Carbon::now()->addHours(1);

        return array("token" => $token, "resultToken" => $resultToken);
    }
}
