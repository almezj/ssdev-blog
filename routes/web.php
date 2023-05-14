<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PagesController::class, 'index']);

Route::resource('/blog', PostsController::class);

Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Posts filtering
Route::get('/posts/search', 'App\Http\Controllers\PostsController@search')->name('posts.search');
Route::get('/posts', [PostsController::class, 'index'])->name('posts.index');

//Favorite posts
Route::post('/posts/{post}/favorite', [FavoriteController::class, 'addFavorite'])->name('posts.favorite');
Route::delete('/posts/{post}/unfavorite', [FavoriteController::class, 'removeFavorite'])->name('posts.unfavorite');


//Favorite posts page
Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites');

//Post comments
Route::post('/comments/{post}', [CommentController::class, 'store'])->name('comments.store');


