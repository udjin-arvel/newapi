<?php

namespace App\Http\Controllers\Api;

use App\Http\Filters\Filter;
use App\Http\Resources\CompositionResource;
use App\Models\Composition;

/**
 * Class StoryController
 * @package App\Http\Controllers\Api
 *
 * @property mixed $input
 */
class CompositionController extends CrudController
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Composition::class;
    }
    
    /**
     * @return string
     */
    protected function getResourceClass(): string
    {
        return CompositionResource::class;
    }
    
    /**
     * @return Filter|null
     */
    protected function getFilter()
    {
        return null;
    }
}
