<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\NoteResource;
use App\Models\Note;

/**
 * Class StoryController
 * @package App\Http\Controllers\Api
 *
 * @property mixed $input
 */
class NoteController extends CrudController
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Note::class;
    }
    
    /**
     * @return string
     */
    protected function getResourceClass(): string
    {
        return NoteResource::class;
    }
}
