<?php
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Author\PostController as AuthorPostController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function() {
	Route::resource('posts', PostController::class);
    Route::resource('photos', PhotoController::class);
    Route::get('/home', [PostController::class, 'index'])->name('home');
});

Route::get('/test', [PostController::class, 'test']);

Auth::routes();

// // Admin Routes
// Route::prefix('admin')->group(function () {
//     // Routes for managing users
//     Route::resource('/users', AdminUserController::class)->names('admin.users');

//     // Routes for managing blog posts
//     Route::resource('/posts', AdminPostController::class)->names('admin.posts');
// });

// // Author Routes
// Route::prefix('author')->group(function () {
//     // Routes for managing their own blog posts
//     Route::resource('/posts', AuthorPostController::class)->names('author.posts');
// });

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
