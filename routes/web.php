<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

Route::get('/', HomeController::class)->name('home');
Route::get('/blog', [PostController::class, 'index'])->name('post.index');
Route::get('/blog/{post:slug}', [PostController::class, 'show'])->name('post.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
});
