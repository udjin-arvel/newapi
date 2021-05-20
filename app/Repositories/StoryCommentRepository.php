<?php

namespace App\Repositories;

use App\Models\StoryComment;
use App\Repositories\Traits\MassSaveTrait;

/**
 * Class StoryCommentRepository
 * @package App\Repositories
 */
class StoryCommentRepository extends Repository
{
    use MassSaveTrait;
    
    /**
     * @return mixed|string
     */
    protected function getModelClass()
    {
        return StoryComment::class;
    }
}