<?php
namespace App\Repositories;

use App\Models\News;

class NewsRepository implements NewsRepositoryInterface{
    public function findAll(){
        return News::paginate(4);
    }

    public function findById($id){
        return News::find($id);
    }

    public function store($data){
        News::create($data);
    }

    public function update($news, $data){
        $news->update($data);
    }

    public function delete($news)
    {
        $news->delete();
    }
}

?>
