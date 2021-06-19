<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\Traits\ChapteredTrait;
use App\Repositories\Interfaces\Chapterable;
use App\Repositories\Interfaces\IWriteableRepository;
use App\Repositories\Traits\BaseRepositoryMethodsTrait;

/**
 * Class BookRepository
 * @package App\Repositories
 */
class BookRepository extends Repository implements IWriteableRepository, Chapterable
{
    use ChapteredTrait,
        BaseRepositoryMethodsTrait;
    
    /**
     * @return mixed|string
     */
    protected function getModelClass() {
        return Book::class;
    }
    
    /**
     * @return array
     */
    public function all()
    {
        return get_class($this->model)::orderBy('created_at', 'desc')
            ->get()
            ->map(function ($book) {
                $book['short_description'] = cutOffByWords($book['description'],36);
                return $book;
            });
    }
}
