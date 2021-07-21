<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\CrudController;
use App\Models\Story;
use App\Http\Resources\StoryResource;

/**
 * Class StoryController
 * @package App\Http\Controllers\Api
 *
 * @property mixed $input
 */
class StoryController extends CrudController
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Story::class;
    }
    
    /**
     * @return string
     */
    protected function getResourceClass(): string
    {
        return StoryResource::class;
    }
}
