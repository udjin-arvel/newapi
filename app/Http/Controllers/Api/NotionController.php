<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\CrudController;
use App\Http\Resources\NotionResource;
use App\Models\Notion;

/**
 * Class StoryController
 * @package App\Http\Controllers\Api
 *
 * @property mixed $input
 */
class NotionController extends CrudController
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Notion::class;
    }
    
    /**
     * @return string
     */
    protected function getResourceClass(): string
    {
        return NotionResource::class;
    }
}
