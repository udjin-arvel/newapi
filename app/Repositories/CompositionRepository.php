<?php

namespace App\Repositories;

use App\Models\Composition;

/**
 * Class CompositionRepository
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
