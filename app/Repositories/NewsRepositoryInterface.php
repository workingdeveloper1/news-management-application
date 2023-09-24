<?php

namespace App\Repositories;

interface NewsRepositoryInterface
{
    public function findAll();
    public function findById($id);
    public function store($data);
    public function update($news, $data);
    public function delete($news);
}

?>
