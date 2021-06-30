<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\CrudController;
use App\Http\Resources\NoteResource;
use App\Repositories\NoteRepository;
use App\Repositories\Repository;

/**
 * Class StoryController
 * @package App\Http\Controllers\Api
 *
 * @property mixed $input
 */
class NoteController extends CrudController
{
    /**
     * @return Repository
     */
    protected function getRepository(): Repository
    {
        return new NoteRepository;
    }
    
    /**
     * @return string
     */
    protected function getResourceClass(): string
    {
        return NoteResource::class;
    }
}
