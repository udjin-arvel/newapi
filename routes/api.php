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
	Route::get('getBasicData', 'Api\BookController@getBasicData');
    Route::post('saveStory', 'Api\BookController@saveStory');
    
    Route::get('stories', 'Api\BookController@getStories');
    Route::get('story/{id}', 'Api\BookController@getStory');
    Route::get('getBookChapters/{id}', 'Api\BookController@getBookChapters');
	Route::delete('deleteStory/{id}', 'Api\BookController@deleteStory');
    Route::get('getBooks', 'Api\BookController@getBooks');
    Route::get('getBook/{id}', 'Api\BookController@getBook');
    Route::post('saveBook', 'Api\BookController@saveBook');
    Route::delete('deleteBook/{id}', 'Api\BookController@deleteBook');
    
    Route::post('projectToStory', 'Api\BookController@projectToStory');
    Route::post('saveStoryProject', 'Api\BookController@saveStoryProject');
    Route::get('getStoryProjects', 'Api\BookController@getStoryProjects');
    Route::get('getStoryProject/{id}', 'Api\BookController@getStoryProject');
    
    Route::get('getContent', 'Api\BookController@getContent');
    Route::post('addCard', 'Api\BookController@addCard');
    Route::get('getCard/{id}', 'Api\BookController@getCard');
    Route::get('buyCard/{id}', 'Api\BookController@buyCard');
    Route::get('buyStory/{id}', 'Api\BookController@buyStory');
    Route::get('deleteCard/{id}', 'Api\BookController@deleteCard');
    
    Route::get('exchangeExperience/{xcoins}', 'Api\BookController@exchangeExperience');
    Route::post('changePassword', 'Api\UserController@changePassword');
    
    Route::get('getLines', 'Api\BookController@getLines');
    Route::post('changeLineName', 'Api\BookController@changeLineName');
    
    Route::get('getStatistic', 'Api\BookController@getStatistic');
    
    Route::get('getLoreItems', 'Api\BookController@getLoreItems');
    Route::post('addLoreItem', 'Api\BookController@addLoreItem');
    Route::delete('deleteLoreItem/{id}', 'Api\BookController@deleteLoreItem');
    
    Route::get('getNotes', 'Api\BookController@getNotes');
	Route::post('saveNote', 'Api\BookController@saveNote');
	Route::delete('deleteNote/{id}', 'Api\BookController@deleteNote');
    
    Route::post('correct', 'Api\BookController@correct');
    Route::post('report', 'Api\BookController@report');
	
	Route::get('notions', 'Api\BookController@getNotions');
	Route::get('notion/{id}', 'Api\BookController@getNotion');
	Route::get('getNotionGallery/{id}', 'Api\BookController@getNotionGallery');
	Route::post('saveNotion', 'Api\BookController@saveNotion');
	Route::delete('deleteNotion/{id}', 'Api\BookController@deleteNotion');
    
    Route::post('addImage', 'Api\BookController@addImage');
    Route::delete('deleteImage/{id}', 'Api\BookController@deleteImage');
    
    Route::get('tags', 'Api\BookController@getTags');
	Route::post('saveTag', 'Api\BookController@saveTag');
    
    Route::post('like', 'Api\BookController@like');
    
    Route::get('comments/{id}', 'Api\BookController@comments');
    Route::post('comment', 'Api\BookController@comment');
    Route::delete('deleteComment/{id}', 'Api\BookController@deleteComment');
    
    Route::get('getSubscriptionsStories', 'Api\UserController@getSubscriptionsStories');
    Route::post('subscribe', 'Api\BookController@subscribe');
    Route::get('getUserData', 'Api\UserController@details');
    Route::post('editProfile', 'Api\UserController@editProfile');
    Route::get('getProfileByUserId/{id}', 'Api\UserController@getProfileByUserId');
    
    Route::post('chooseClan', 'Api\BookController@chooseClan');
    
    Route::get('getDialogs', 'Api\BookController@getDialogs');
    Route::post('createDialog', 'Api\BookController@createDialog');
    Route::post('sendMessage', 'Api\BookController@sendMessage');
    Route::post('messagesRead', 'Api\BookController@messagesRead');
    Route::delete('deleteDialog/{id}', 'Api\BookController@deleteDialog');
});
