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
    Route::get('getBasicData', 'Api\SiteController@getBasicData');
    
    // ------------------------ Story routes ------------------------ //
	Route::resource('stories', 'Api\StoryController');
    
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
	
	// ------------------------ Comment routes ------------------------ //
	Route::resource('comments', 'Api\CommentController');
    
    // ------------------------ Notion routes ------------------------ //
	Route::resource('notions', 'Api\NotionController');
	
	// ------------------------ Description routes ------------------------ //
	Route::resource('descriptions', 'Api\DescriptionController');
    
    // ------------------------ Tag routes ------------------------ //
    Route::get('tag/all', 'Api\TagController@all');
    Route::post('tag/save', 'Api\TagController@save');
    Route::delete('tag/delete/{id}', 'Api\TagController@delete');
	
	// ------------------------ Like routes ------------------------ //
	Route::group(['middleware' => 'like.check'], function() {
		Route::get('like', 'Api\LikeController@like');
		Route::get('dislike', 'Api\LikeController@dislike');
		Route::get('likeToggle', 'Api\LikeController@likeToggle');
	});
});
