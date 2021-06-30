<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\CrudController;
use App\Http\Resources\NotionResource;
use App\Repositories\NotionRepository;
use App\Repositories\Repository;

/**
 * Class StoryController
 * @package App\Http\Controllers\Api
 *
 * @property mixed $input
 */
class NotionController extends CrudController
{
    /**
     * @return Repository
     */
    protected function getRepository(): Repository
    {
        return new NotionRepository;
    }
    
    /**
     * @return string
     */
    protected function getResourceClass(): string
    {
        return NotionResource::class;
    }
}
