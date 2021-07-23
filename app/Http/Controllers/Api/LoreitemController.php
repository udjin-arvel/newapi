<?php

namespace App\Http\Controllers\Api;

use App\Http\Filters\Filter;
use App\Http\Resources\LoreItemResource;
use App\Models\LoreItem;

/**
 * Class StoryController
 * @package App\Http\Controllers\Api
 *
 * @property mixed $input
 */
class LoreitemController extends CrudController
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return LoreItem::class;
    }
    
    /**
     * @return string
     */
    protected function getResourceClass(): string
    {
        return LoreItemResource::class;
    }
    
    /**
     * @return Filter|null
     */
    protected function getFilter()
    {
        return null;
    }
}
