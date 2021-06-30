<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\CrudController;
use App\Repositories\Repository;
use App\Repositories\StoryRepository;
use App\Http\Resources\StoryResource;
use Illuminate\Http\JsonResponse;

/**
 * Class StoryController
 * @package App\Http\Controllers\Api
 *
 * @property mixed $input
 */
class StoryController extends CrudController
{
    /**
     * @return Repository
     */
    protected function getRepository(): Repository
    {
        return new StoryRepository;
    }
    
    /**
     * @return string
     */
    protected function getResourceClass(): string
    {
        return StoryResource::class;
    }
}
