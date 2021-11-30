<?php

namespace App\Http\Controllers\Api;

use App\Facades\Enum;
use App\Http\Controllers\Controller;
use App\Http\Resources\CompositionResource;
use App\Http\Resources\LoreItemResource;
use App\Http\Resources\NewsResource;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\StoryResource;
use App\Models\Composition;
use App\Models\LoreItem;
use App\Models\News;
use App\Models\Notification;
use App\Models\Notion;
use App\Models\Story;

/**
 * Class BookController
 * @package App\Http\Controllers\Api
 */
class SiteController extends Controller
{
	/**
	 *
	 */
	const HOME_CONTENT_AMOUNT_LIMIT = 10;
	
	
    /**
     * Получить базовые данные (кофиги)
     */
    public function getPresetData()
    {
        return $this->sendSuccess([
	        'aliases'       => Enum::aliases(),
	        'types'         => Enum::types(),
	        'statuses'      => Enum::statuses(),
	        'notifications' => NotificationResource::collection(Notification::with('user')->get()),
        ]);
    }
	
	/**
	 * Получить контент для главной страницы
	 */
    public function getHomeContent()
    {
	    $stories      = Story::orderBy('created_at', 'desc')->limit(self::HOME_CONTENT_AMOUNT_LIMIT)->get();
	    $news         = News::orderBy('created_at', 'desc')->limit(self::HOME_CONTENT_AMOUNT_LIMIT)->get();
	    $compositions = Composition::orderBy('created_at', 'desc')->limit(self::HOME_CONTENT_AMOUNT_LIMIT)->get();
	    $notions      = Notion::orderBy('created_at', 'desc')->limit(self::HOME_CONTENT_AMOUNT_LIMIT)->get();
	    $loreItems    = LoreItem::orderBy('created_at', 'desc')->limit(self::HOME_CONTENT_AMOUNT_LIMIT)->get();
	    
	    return $this->sendSuccess([
		    'stories'      => StoryResource::collection($stories),
		    'news'         => NewsResource::collection($news),
		    'compositions' => CompositionResource::collection($compositions),
		    'notions'      => NotificationResource::collection($notions),
		    'loreItems'    => LoreItemResource::collection($loreItems),
	    ]);
    }
}
