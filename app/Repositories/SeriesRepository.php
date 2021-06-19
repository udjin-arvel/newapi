<?php

namespace App\Repositories;

use App\Models\Series;
use App\Models\Traits\ChapteredTrait;
use App\Repositories\Interfaces\Chapterable;
use App\Repositories\Interfaces\IWriteableRepository;
use App\Repositories\Traits\BaseRepositoryMethodsTrait;

/**
 * Class SeriesRepository
 * @package App\Repositories
 */
class SeriesRepository extends Repository implements IWriteableRepository, Chapterable
{
    use BaseRepositoryMethodsTrait,
        ChapteredTrait;
    
    /**
     * @return mixed|string
     */
    protected function getModelClass() {
        return Series::class;
    }
}
