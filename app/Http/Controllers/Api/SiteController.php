<?php

namespace App\Http\Controllers\Api;

use App\Facades\Enum;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;

/**
 * Class BookController
 * @package App\Http\Controllers\Api
 */
class SiteController extends Controller
{
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
}
