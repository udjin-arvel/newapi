<?php

namespace App\Repositories;

use App\Models\LoreItem as Model;
use App\Repositories\Interfaces\IWriteableRepository;
use App\Repositories\Traits\BaseRepositoryMethodsTrait;

/**
 * Class LoreItemRepository
 * @package App\Repositories
 */
class LoreItemRepository extends Repository implements IWriteableRepository
{
    use BaseRepositoryMethodsTrait;
    
    /**
     * @return mixed|string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}
