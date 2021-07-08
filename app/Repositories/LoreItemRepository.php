<?php

namespace App\Repositories;

use App\Models\LoreItem as Model;

/**
 * Class LoreItemRepository
 * @package App\Repositories
 */
class LoreItemRepository extends CrudRepository
{
    /**
     * @return mixed|string
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }
}
