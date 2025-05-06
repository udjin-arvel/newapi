<?php

use App\Http\Controllers\Api;
use Illuminate\Support\Facades\Route;

// ------------------------ Start routes ------------------------ //
Route::post('login', [Api\UserController::class, 'login']);
Route::post('register', [Api\UserController::class, 'register']);
Route::get('notifications', [Api\SiteController::class, 'notifications']);
Route::get('news', [Api\SiteController::class, 'news']);
Route::get('tags', [Api\SiteController::class, 'tags']);
Route::get('types/{alias}', [Api\SiteController::class, 'types']);
Route::get('statuses/{alias}', [Api\SiteController::class, 'statuses']);
Route::get('listByContentType/{type}', [Api\SiteController::class, 'listByContentType']);
Route::get('useName/{id}', [Api\NameController::class, 'useName']);
Route::get('getCharacterTraits', [Api\CharacterController::class, 'getCharacterTraits']);

// ------------------------ Like routes ------------------------ //
Route::get('like', [Api\LikeController::class, 'like']);
Route::get('dislike', [Api\LikeController::class, 'dislike']);
Route::get('likeToggle', [Api\LikeController::class, 'likeToggle']);

// ------------------------ Story routes ------------------------ //
Route::resource('stories', Api\StoryController::class)->only(['index', 'show']);
Route::get('getAdjacentChapters/{compositionId}/{storyId}', [Api\StoryController::class, 'getAdjacentChapters']);

// ------------------------ Fragment routes ------------------------ //
Route::resource('fragments', Api\FragmentController::class)->only(['index', 'show']);

// ------------------------ Notes routes ------------------------ //
Route::resource('notes', Api\NoteController::class)->only(['index', 'show']);

// ------------------------ Loreitems routes ------------------------ //
Route::resource('loreitems', Api\LoreitemController::class)->only(['index', 'show']);

// ------------------------ Composition routes ------------------------ //
Route::resource('compositions', Api\CompositionController::class)->only(['index', 'show']);

// ------------------------ Comment routes ------------------------ //
Route::resource('comments', Api\CommentController::class)->only(['index', 'show']);

// ------------------------ Notion routes ------------------------ //
Route::resource('notions', Api\NotionController::class)->only(['index', 'show']);

// ------------------------ Description routes ------------------------ //
Route::resource('descriptions', Api\DescriptionController::class)->only(['index', 'show']);

// ------------------------ Short routes ------------------------ //
Route::resource('shorts', Api\ShortController::class)->only(['index', 'show']);

// ------------------------ Subscription routes ------------------------ //
Route::resource('subscriptions', Api\SubscriptionController::class)->only(['index', 'show']);

// ------------------------ Name routes ------------------------ //
Route::resource('names', Api\NameController::class)->only(['index', 'show']);

// ------------------------ Character routes ------------------------ //
Route::resource('characters', Api\CharacterController::class)->only(['index', 'show']);

// Api routes with need authorization
Route::group(['middleware' => 'auth:api'], function() {
    Route::post('editProfile', [Api\UserController::class, 'editProfile']);

    // ------------------------ Gallery routes ------------------------ //
    Route::post('saveNotionGallery', [Api\NotionController::class, 'saveGallery']);
    Route::post('saveLoreGallery', [Api\LoreItemController::class, 'saveGallery']);
    Route::post('saveCompositionGallery', [Api\CompositionController::class, 'saveGallery']);
    Route::post('saveCharacterGallery', [Api\CharacterController::class, 'saveGallery']);

    // ------------------------ Story routes ------------------------ //
	Route::resource('stories', Api\StoryController::class)->only(['store', 'update', 'destroy']);

    // ------------------------ Fragment routes ------------------------ //
    Route::resource('fragments', Api\FragmentController::class)->only(['store', 'update', 'destroy']);

    // ------------------------ Notes routes ------------------------ //
	Route::resource('notes', Api\NoteController::class)->only(['store', 'update', 'destroy']);

    // ------------------------ Loreitems routes ------------------------ //
	Route::resource('loreitems', Api\LoreitemController::class)->only(['store', 'update', 'destroy']);

    // ------------------------ Composition routes ------------------------ //
	Route::resource('compositions', Api\CompositionController::class)->only(['store', 'update', 'destroy']);

	// ------------------------ Comment routes ------------------------ //
	Route::resource('comments', Api\CommentController::class)->only(['store', 'update', 'destroy']);

    // ------------------------ Notion routes ------------------------ //
	Route::resource('notions', Api\NotionController::class)->only(['store', 'update', 'destroy']);

	// ------------------------ Description routes ------------------------ //
	Route::resource('descriptions', Api\DescriptionController::class)->only(['store', 'update', 'destroy']);

	// ------------------------ Short routes ------------------------ //
	Route::resource('shorts', Api\ShortController::class)->only(['store', 'update', 'destroy']);

	// ------------------------ Subscription routes ------------------------ //
	Route::resource('subscriptions', Api\SubscriptionController::class)->only(['store', 'update', 'destroy']);

	// ------------------------ Name routes ------------------------ //
	Route::resource('names', Api\NameController::class)->only(['store', 'update', 'destroy']);

    // ------------------------ Character routes ------------------------ //
    Route::resource('characters', Api\CharacterController::class)->only(['store', 'update', 'destroy']);
});

// Arvelov Landings Routes
Route::post('addCallbackRequest', [Api\LandingController::class, 'addCallbackRequest']);
Route::post('addGostRequest', [Api\LandingController::class, 'addGostRequest']);
Route::post('addGentRequest', [Api\LandingController::class, 'addGentRequest']);
