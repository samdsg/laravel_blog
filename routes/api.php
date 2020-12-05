<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
use App\Models\Article;
use App\Http\Resources\Article as ArticleResource;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('articles', function () {
    // If the Content-Type and Accept headers are set to 'application/json', 
    // this will return a JSON structure. This will be cleaned up later.
    $article = Article::paginate(5);
    return  ArticleResource::collection($article);
});

Route::get('articles/{id}', function ($id) {
    $article = Article::find($id);
    return new ArticleResource($article);
});

Route::post('articles', function (Request $request) {
    return Article::create($request->all);
});

Route::put('articles/{id}', function (Request $request, $id) {
    $article = Article::findOrFail($id);
    $article->update($request->all());

    return $article;
});

Route::delete('articles/{id}', function ($id) {
    Article::find($id)->delete();

    return 204;
});
