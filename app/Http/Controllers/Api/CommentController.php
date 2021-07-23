<?php

namespace App\Http\Controllers\Api;

use App\Http\Filters\CommentFilter;
use App\Http\Resources\CommentResource;
use App\Models\Comment;

/**
 * Class StoryController
 * @package App\Http\Controllers\Api
 *
 * @property mixed $input
 */
class CommentController extends CrudController
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Comment::class;
    }
    
    /**
     * @return string
     */
    protected function getResourceClass()
    {
        return CommentResource::class;
    }
    
    /**
     * @return CommentFilter
     */
    protected function getFilter()
    {
        return new CommentFilter;
    }
}
