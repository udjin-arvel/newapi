<?php

namespace App\Repositories;

use App\Models\Composition;

/**
 * Class BookRepository
 * @package App\Repositories
 */
class CompositionRepository extends CrudRepository
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Composition::class;
    }
}
