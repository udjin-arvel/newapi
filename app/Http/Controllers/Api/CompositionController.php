<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\CrudController;
use App\Http\Resources\CompositionResource;
use App\Repositories\CompositionRepository;
use App\Repositories\Repository;

/**
 * Class StoryController
 * @package App\Http\Controllers\Api
 *
 * @property mixed $input
 */
class CompositionController extends CrudController
{
    /**
     * @return Repository
     */
    protected function getRepository(): Repository
    {
        return new CompositionRepository;
    }
    
    /**
     * @return string
     */
    protected function getResourceClass(): string
    {
        return CompositionResource::class;
    }
}
