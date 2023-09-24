<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register']);

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('/news/{id}', [NewsController::class, 'getDetail']);
    Route::get('/news', [NewsController::class, 'getAll']);
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::group(['middleware' => ['auth:api', 'can:create-news', 'can:update-news', 'can:delete-news']], function(){
    Route::post('/news', [NewsController::class, 'store']);
    Route::post('/news/{id}', [NewsController::class, 'update']);
    Route::delete('/news/{id}', [NewsController::class, 'delete']);
});

Route::group(['middleware' => ['auth:api', 'can:comment-news']], function(){
    Route::post('/news/{news_id}/comment', [CommentController::class, 'store']);
});

