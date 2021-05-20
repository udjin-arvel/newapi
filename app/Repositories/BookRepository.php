<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\Traits\ChapteredTrait;
use App\Repositories\Interfaces\IWriteableRepository;
use App\Repositories\Traits\BaseRepositoryMethodsTrait;

/**
 * Class BookRepository
 * @package App\Repositories
 */
class BookRepository extends Repository implements IWriteableRepository
{
    use ChapteredTrait,
        BaseRepositoryMethodsTrait;
    
    /**
     * @return mixed|string
     */
    protected function getModelClass() {
        return Book::class;
    }
}
