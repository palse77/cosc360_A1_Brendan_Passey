<?php

use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', [UserController::class, 'index']);

Route::get('/posts', [PostController::class, 'index']); 
Route::get('/posts/{id}', [PostController::class, 'show']);
