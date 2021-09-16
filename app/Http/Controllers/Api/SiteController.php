<?php

namespace App\Http\Controllers\Api;

use App\Models\Connection;
use App\Models\Description;
use App\Models\Enums\Targets;
use App\Http\Controllers\Controller;
use App\Models\Notion;

/**
 * Class BookController
 * @package App\Http\Controllers\Api
 */
class SiteController extends Controller
{
    /**
     * Получить базовые данные для TheBook
     */
    public function getBasicData()
    {
        return $this->sendSuccess([
	        'types' => [
		        'notion'      => Notion::TYPES,
		        'description' => Description::TYPES,
	        ],
            'targets' => [
	            'content' => Targets::LIST,
            ],
            'statuses' => [
                'connection' => Connection::STATUSES,
            ],
        ]);
    }
}
