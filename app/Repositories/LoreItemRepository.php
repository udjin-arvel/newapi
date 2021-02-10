<?php

namespace App\Repositories;

use App\Exceptions\TBError;
use App\Models\LoreItem as Model;

/**
 * Class LoreItemRepository
 * @package App\Repositories
 */
class LoreItemRepository extends Repository
{
    /**
     * @return mixed|string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}
