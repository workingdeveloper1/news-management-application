<?php
namespace App\Repositories;

use App\Models\News;

class NewsRepository implements NewsRepositoryInterface{
    public function findAll(){
        return News::simplePaginate(4);
    }

    public function findById($id){
        // return News::with('comments')->find($id);
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
