<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\CrudController;
use App\Http\Resources\TagResource;
use App\Repositories\Repository;
use App\Repositories\TagRepository;

/**
 * Class StoryController
 * @package App\Http\Controllers\Api
 *
 * @property mixed $input
 */
class TagController extends CrudController
{
    /**
     * @return Repository
     */
    protected function getRepository(): Repository
    {
        return new TagRepository;
    }
    
    /**
     * @return string
     */
    protected function getResourceClass(): string
    {
        return TagResource::class;
    }
}
