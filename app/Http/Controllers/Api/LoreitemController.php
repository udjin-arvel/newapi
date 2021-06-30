<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\CrudController;
use App\Http\Resources\LoreItemResource;
use App\Repositories\LoreItemRepository;
use App\Repositories\Repository;

/**
 * Class StoryController
 * @package App\Http\Controllers\Api
 *
 * @property mixed $input
 */
class LoreitemController extends CrudController
{
    /**
     * @return Repository
     */
    protected function getRepository(): Repository
    {
        return new LoreItemRepository;
    }
    
    /**
     * @return string
     */
    protected function getResourceClass(): string
    {
        return LoreItemResource::class;
    }
}
