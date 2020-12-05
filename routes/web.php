<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

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

Route::get('/', function(){
    return view('welcome');
});

// Get all Posts
Route::get("posts", [ArticleController::class, 'index']);

// Get a Single Post
Route::get("post/{id}", [ArticleController::class, 'show']);

// Create a new post
Route::post('post', [ArticleController::class, 'store']);

// Update a post
Route::put("post/{id}", [ArticleController::class, 'update']);

// Delete a post
Route::delete('post/{id}', [ArticleController::class, 'destroy']);
