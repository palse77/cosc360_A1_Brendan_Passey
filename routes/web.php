<?php

use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Author\PostController as AuthorPostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function() {
    // Home Route Logic for Admin and Author
    Route::get('/home', function() {
        if (Auth::user()->admin) {
            return redirect()->route('admin.posts.index');  // Redirect admin to admin post index
        }
        return redirect()->route('author.posts.index');  // Redirect author to author post index
    })->name('home');

    
    Route::resource('posts', PostController::class);  // This ensures 'posts.create' works

    // Author Routes (non-admin)
    Route::prefix('author')->group(function () {
        Route::resource('posts', PostController::class)->names('author.posts');  // Route authors to the standard PostController
    });

    // Other general routes for authenticated users
    Route::resource('photos', PhotoController::class);
});

Route::get('/test', [PostController::class, 'test']);

Auth::routes();

// Admin Routes with AdminMiddleware applied
Route::group(['middleware' => ['auth', 'admin']], function() {
    Route::prefix('admin')->group(function () {
        Route::resource('/posts', AdminPostController::class)->names('admin.posts');  // Admin-specific routes
        Route::resource('/users', AdminUserController::class)->names('admin.users');  // Admin-specific routes
    });
});
