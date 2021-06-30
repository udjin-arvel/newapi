<?php

namespace App\Http\Controllers\Api;

use App\Models\Note;
use App\Http\Controllers\Controller;

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
            'note_types' => Note::getTypes(),
        ]);
    }
}
