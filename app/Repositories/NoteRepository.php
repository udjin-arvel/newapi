<?php
	
namespace App\Repositories;

use App\Models\Note as Model;

/**
 * Class NoteRepository
 * @package App\Repositories
 */
class NoteRepository extends CrudRepository
{
    /**
     * @return mixed|string
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }
}