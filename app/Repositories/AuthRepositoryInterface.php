<?php

namespace App\Repositories;

interface AuthRepositoryInterface
{
    public function saveToken($token);
    public function register($data);
}

?>
