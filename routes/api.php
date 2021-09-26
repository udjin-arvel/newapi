<?php

use App\Http\Controllers\Api;

Route::post('authorize', 'Api\UserController@auth');
Route::get('confirm', 'Api\SiteController@confirmMail');

Route::group(['middleware' => 'auth:api'], function() {
    // ------------------------ Basic routes ------------------------ //
    Route::get('presets', [Api\SiteController::class, 'getPresetData']);
    
    // ------------------------ Story routes ------------------------ //
	Route::resource('stories', Api\StoryController::class);
    
    // ------------------------ Notes routes ------------------------ //
	Route::resource('notes', Api\NoteController::class);
	
    // ------------------------ Loreitems routes ------------------------ //
	Route::resource('loreitems', Api\LoreItemController::class);
    
    // ------------------------ Composition routes ------------------------ //
	Route::resource('compositions', Api\CompositionController::class);
	
	// ------------------------ Comment routes ------------------------ //
	Route::resource('comments', Api\CommentController::class);
    
    // ------------------------ Notion routes ------------------------ //
	Route::resource('notions', Api\NotionController::class);
	
	// ------------------------ Description routes ------------------------ //
	Route::resource('descriptions', Api\DescriptionController::class);
    
    // ------------------------ Tag routes ------------------------ //
	Route::resource('tags', Api\TagController::class);
	
	// ------------------------ Subscription routes ------------------------ //
	Route::resource('subscriptions', Api\SubscriptionController::class);
	
	// ------------------------ Like routes ------------------------ //
	Route::get('like', [Api\LikeController::class, 'like']);
	Route::get('dislike', [Api\LikeController::class, 'dislike']);
	Route::get('likeToggle', [Api\LikeController::class, 'likeToggle']);
});
