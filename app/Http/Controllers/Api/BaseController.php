<?php

namespace App\Http\Controllers\Api;

use App\Models\Connection;
use App\Models\Note;
use App\Http\Controllers\Controller;
use App\Models\Notion;

/**
 * Class BookController
 * @package App\Http\Controllers\Api
 */
class BaseController extends Controller
{
    /**
     * Получить базовые данные для TheBook
     */
    public function getBasicData()
    {
        return $this->sendSuccess([
            'types' => [
                'note'   => Note::TYPES,
                'notion' => Notion::TYPES,
            ],
            'statuses' => [
                'connection' => Connection::STATUSES,
            ],
        ]);
    }
}
