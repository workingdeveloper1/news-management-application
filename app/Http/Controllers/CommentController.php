<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\News;
use App\Repositories\CommentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ResponseFormatter;
use App\Helpers\ValidatorHelper;
use App\Jobs\CreateComment;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    private CommentRepositoryInterface $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function store(Request $request, $news_id){
        $validator = ValidatorHelper::makeCommentValidator($request);

        if ($validator->fails()) {
            return ResponseFormatter::error(null, "Unprocessable Entity", 422, $validator->errors());
        }

        $validatedData = $validator->validated();

        $validatedData['news_id'] = $news_id;
        $validatedData['user_id'] = $request->user()->id;

        CreateComment::dispatch($this->commentRepository, $validatedData);

        return ResponseFormatter::success($validatedData, "Comment has been posted", 201, 'success');

    }

}
