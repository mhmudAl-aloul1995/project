<?php

use Illuminate\Http\Request;
use App\Article;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('getProjectApi','projectController@getProjectApi');
Route::get('getLinkApi','linkController@getLinkApi');
Route::get('getArticleMaterialApi','articleController@getArticleMaterialApi');
Route::get('getArticleMainApi','articleController@getArticleMainApi');
Route::get('getOfferApi','offerController@getOfferApi');
Route::post('postMaterialApi','materialController@postMaterialApi');
Route::post('postSubplaylistApi','subplaylistController@postSubplaylistApi');
Route::post('postPlaylistApi','playListController@postPlaylistApi');
