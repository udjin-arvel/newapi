<?php
	
namespace App\Repositories;

use App\Models\Note as Model;
use App\Repositories\Interfaces\IWriteableRepository;
use App\Repositories\Traits\BaseRepositoryMethodsTrait;

/**
 * Class NoteRepository
 * @package App\Repositories
 */
class NoteRepository extends Repository implements IWriteableRepository
{
    use BaseRepositoryMethodsTrait;
    
    /**
     * @return mixed|string
     */
    protected function getModelClass() {
        return Model::class;
    }
}