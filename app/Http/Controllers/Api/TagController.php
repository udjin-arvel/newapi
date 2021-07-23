<?php

namespace App\Http\Controllers\Api;

use App\Http\Filters\Filter;
use App\Http\Resources\TagResource;
use App\Models\Tag;

/**
 * Class StoryController
 * @package App\Http\Controllers\Api
 *
 * @property mixed $input
 */
class TagController extends CrudController
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Tag::class;
    }
    
    /**
     * @return string
     */
    protected function getResourceClass(): string
    {
        return TagResource::class;
    }
    
    /**
     * @return Filter|null
     */
    protected function getFilter()
    {
        return null;
    }
}
