<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return view('home');
});

Route::get('/posts', [PostController::class, 'index'])->name('posts');

Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('post');

Route::get('/authors/{user}', [PostController::class, 'index'])->name('author');

Route::get('/promoted', [PostController::class, 'promoted'])->name('posts.promoted');

Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::post('/comment', [CommentController::class, 'store'])->name('comment');


Route::delete('/posts/{post}/comments/{comment}', [CommentController::class, 'delete'])->name('comments.delete');



