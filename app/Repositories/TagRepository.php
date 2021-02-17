<?php
	
namespace App\Repositories;

use App\Exceptions\TBError;
use App\Models\Tag;

/**
 * Class TagRepository
 * @package App\Repositories
 */
class TagRepository extends Repository
{
    /**
     * @return mixed|string
     */
    protected function getModelClass() {
        return Tag::class;
    }
}