<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostTagController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store')->middleware(ProtectAgainstSpam::class);
Route::post('/comments/{comment}/replies', [CommentController::class, 'storeReply'])->name('comments.store-reply');
Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
Route::get('/posts/tag/{tag:slug}', [PostTagController::class, 'show'])->name('posts-tags.show');
