<?php

use App\Http\Controllers\Api;

Route::post('login', [Api\UserController::class, 'login']);
Route::post('register', [Api\UserController::class, 'register']);

Route::group(['middleware' => 'auth:api'], function() {
    // ------------------------ Start routes ------------------------ //
    Route::get('notifications', [Api\SiteController::class, 'notifications']);
    Route::get('news', [Api\SiteController::class, 'news']);
    Route::get('tags', [Api\SiteController::class, 'tags']);
    Route::get('types/{alias}', [Api\SiteController::class, 'types']);
    Route::get('statuses/{alias}', [Api\SiteController::class, 'statuses']);
    Route::get('listByContentType/{type}', [Api\SiteController::class, 'listByContentType']);
    Route::get('useName/{id}', [Api\NameController::class, 'useName']);
    Route::post('editProfile', [Api\UserController::class, 'editProfile']);
    Route::get('getCharacterTraits', [Api\CharacterController::class, 'getCharacterTraits']);
    
    // ------------------------ Gallery routes ------------------------ //
    Route::post('saveNotionGallery', [Api\NotionController::class, 'saveGallery']);
    Route::post('saveLoreGallery', [Api\LoreItemController::class, 'saveGallery']);
    Route::post('saveCompositionGallery', [Api\CompositionController::class, 'saveGallery']);
    Route::post('saveCharacterGallery', [Api\CharacterController::class, 'saveGallery']);
	
	// ------------------------ Like routes ------------------------ //
	Route::get('like', [Api\LikeController::class, 'like']);
	Route::get('dislike', [Api\LikeController::class, 'dislike']);
	Route::get('likeToggle', [Api\LikeController::class, 'likeToggle']);
    
    // ------------------------ Story routes ------------------------ //
	Route::resource('stories', Api\StoryController::class);
    Route::get('getAdjacentChapters/{compositionId}/{storyId}', [Api\StoryController::class, 'getAdjacentChapters']);
    
    // ------------------------ Fragment routes ------------------------ //
    Route::resource('fragments', Api\FragmentController::class);
    
    // ------------------------ Notes routes ------------------------ //
	Route::resource('notes', Api\NoteController::class);
	
    // ------------------------ Loreitems routes ------------------------ //
	Route::resource('loreitems', Api\LoreitemController::class);
    
    // ------------------------ Composition routes ------------------------ //
	Route::resource('compositions', Api\CompositionController::class);
	
	// ------------------------ Comment routes ------------------------ //
	Route::resource('comments', Api\CommentController::class);
    
    // ------------------------ Notion routes ------------------------ //
	Route::resource('notions', Api\NotionController::class);
	
	// ------------------------ Description routes ------------------------ //
	Route::resource('descriptions', Api\DescriptionController::class);
	
	// ------------------------ Short routes ------------------------ //
	Route::resource('shorts', Api\ShortController::class);
	
	// ------------------------ Subscription routes ------------------------ //
	Route::resource('subscriptions', Api\SubscriptionController::class);
	
	// ------------------------ Name routes ------------------------ //
	Route::resource('names', Api\NameController::class);
    
    // ------------------------ Character routes ------------------------ //
    Route::resource('characters', Api\CharacterController::class);
});
