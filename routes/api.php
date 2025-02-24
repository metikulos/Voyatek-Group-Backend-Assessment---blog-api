<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;

Route::middleware(['tokenAuth'])->group(function () {
    Route::apiResource('blogs', BlogController::class);
    Route::apiResource('blogs.posts', PostController::class)->shallow();
    Route::get('blogs/{blog}', [BlogController::class, 'show']);
    Route::post('posts/{post}/like', [LikeController::class, 'store']);
    Route::post('posts/{post}/comment', [CommentController::class, 'store']);
});