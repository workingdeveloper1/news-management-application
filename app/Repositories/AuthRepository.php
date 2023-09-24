<?php
namespace App\Repositories;

use App\Models\User;

class AuthRepository implements AuthRepositoryInterface{
    public function saveToken($token){
        $token->save();
    }
    public function register($data){

        $user = User::create($data);
        $user->assignRole('Basic');
        $user->save();

        return $user;
    }
}

?>
