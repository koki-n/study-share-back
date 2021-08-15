<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;


Route::apiResource('/post', PostController::class);
Route::apiResource('/search', SearchController::class);
Route::apiResource('/comment', CommentController::class);
Route::apiResource('/images', ImageController::class);
Route::apiResource('/user', UserController::class);
