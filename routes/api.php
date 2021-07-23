<?php

use Illuminate\Http\Request;

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

Route::post('authorize', 'Api\UserController@auth');
Route::get('confirm', 'Api\SiteController@confirmMail');

Route::group(['middleware' => 'auth:api'], function() {
    
    // ------------------------ Basic routes ------------------------ //
    Route::get('getBasicData', 'Api\BaseController@getBasicData');
    
    // ------------------------ Story routes ------------------------ //
    Route::get('story/get/{id}', 'Api\StoryController@one');
    Route::get('story/all', 'Api\StoryController@all');
    Route::post('story/save', 'Api\StoryController@save');
    Route::delete('story/delete/{id}', 'Api\StoryController@delete');
    
    // ------------------------ Notes routes ------------------------ //
    Route::get('note/all', 'Api\NoteController@all');
    Route::post('note/save', 'Api\NoteController@save');
    Route::delete('note/delete/{id}', 'Api\NoteController@delete');
    
    // ------------------------ Loreitems routes ------------------------ //
    Route::get('loreitem/all', 'Api\LoreitemController@all');
    Route::post('loreitem/save', 'Api\LoreitemController@save');
    Route::delete('loreitem/delete/{id}', 'Api\LoreitemController@delete');
    
    // ------------------------ Composition routes ------------------------ //
    Route::get('composition/get/{id}', 'Api\CompositionController@one');
    Route::get('composition/all', 'Api\CompositionController@all');
    Route::post('composition/save', 'Api\CompositionController@save');
    Route::delete('composition/delete/{id}', 'Api\CompositionController@delete');
    
    // ------------------------ Notion routes ------------------------ //
    Route::get('notion/get/{id}', 'Api\NotionController@one');
    Route::get('notion/all', 'Api\NotionController@all');
    Route::post('notion/save', 'Api\NotionController@save');
    Route::delete('notion/delete/{id}', 'Api\NotionController@delete');
    
    // ------------------------ Tag routes ------------------------ //
    Route::get('tag/all', 'Api\TagController@all');
    Route::post('tag/save', 'Api\TagController@save');
    Route::delete('tag/delete/{id}', 'Api\TagController@delete');
    
    
    // ------------------------ Comment routes ------------------------ //
    Route::get('comment/all', 'Api\CommentController@all');
    Route::post('comment/save', 'Api\CommentController@save');
    Route::delete('comment/delete/{id}', 'Api\CommentController@delete');
    
});
