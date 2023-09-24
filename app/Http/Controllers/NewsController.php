<?php

namespace App\Http\Controllers;

use App\Events\SuccessCreateNews;
use App\Events\SuccessDeleteNews;
use App\Events\SuccessUpdateNews;
use App\Models\News;
use App\Repositories\NewsRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ResponseFormatter;
use App\Helpers\ImageHelper;
use App\Helpers\ValidatorHelper;

class NewsController extends Controller
{
    private NewsRepositoryInterface $newsRepository;

    public function __construct(NewsRepositoryInterface $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function store(Request $request){
        $validator = ValidatorHelper::makeNewsValidator($request);

        if ($validator->fails()) {
            return ResponseFormatter::error(null, "Unprocessable Entity", 422, $validator->errors());
        }

        $validatedData = $validator->validated();

        $validatedData['image'] = ImageHelper::uploadImage($request);

        $this->newsRepository->store($validatedData);
        event(new SuccessCreateNews($validatedData));

        return ResponseFormatter::success($validatedData, "News has been created", 201, 'success');

    }

    public function update(Request $request, $id){
        $validator = ValidatorHelper::makeNewsValidator($request);

        if ($validator->fails()) {
            return ResponseFormatter::error(null, "Unprocessable Entity", 422, $validator->errors());
        }

        $validatedData = $validator->validated();

        $news = $this->newsRepository->findById($id);

        if ($news) {
            $validatedData['image'] = ImageHelper::uploadImage($request);
            ImageHelper::deleteImage($news->image);
            $this->newsRepository->update($news, $validatedData);
            event(new SuccessUpdateNews($validatedData));

            return ResponseFormatter::success(News::find($news->id), "News has been updated");
        }else{
            return ResponseFormatter::error(null, "News not found", 404, "News not found");
        }
    }

    public function delete($id){
        $news = $this->newsRepository->findById($id);
        if ($news) {
            $this->newsRepository->delete($news);
            ImageHelper::deleteImage($news->image);
            event(new SuccessDeleteNews($news));
            return ResponseFormatter::success(null, "Successfully deleted news");
        }else{
            return ResponseFormatter::error(null, "News not found", 404, "News not found");
        }
    }

    public function getAll(){
        $news = $this->newsRepository->findAll();

        return ResponseFormatter::success($news, "Success Get News List");
    }

    public function getDetail($id){
        $news = $this->newsRepository->findById($id);
        $news['comments'] = $news->comments;

        if ($news) {

            return ResponseFormatter::success($news, "Get news detail");
        }else{
            return ResponseFormatter::error(null, "News not found", 404, "News not found");
        }
    }
}
