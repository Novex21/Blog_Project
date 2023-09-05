<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Article\ArticleController;  //Make sure to import controllers
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Comment\CommentController;  //Make sure to import controllers
use App\Http\Controllers\ProfilePhotoController;  //Make sure to import controllers
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

Route::get('/', [ArticleController::class, 'index']);

Route::get('/articles', [ArticleController::class, 'index']);

Route::get('/articles/detail/{id}', [ArticleController::class, 'detail']);

Route::get('/articles/add', [ArticleController::class, 'add']);
Route::post('/articles/add', [ArticleController::class, 'create']);

Route::get('/articles/delete/{id}', [ArticleController::class, 'delete']);

Route::get('/articles/update/{id}', [ArticleController::class,'edit']);
Route::put('/articles/update/{id}', [ArticleController::class, 'update']);

Route::post('/comments/add', [CommentController::class, 'create']);

Route::get('/comments/delete/{id}', [CommentController::class, 'delete']);

Route::get('/profile', [ProfilePhotoController::class,'profilePanel']);
Route::post('/profile', [ProfilePhotoController::class, 'upload']);

Route::get('/categories/{id}', [CategoryController::class, 'index']);

Auth::routes();


Route::get('/home', [ArticleController::class, 'index']);
