<?php
namespace App\Repositories;

use App\Models\Comment;

class CommentRepository implements CommentRepositoryInterface{
    public function store($data){
        Comment::create($data);
    }
}

?>
