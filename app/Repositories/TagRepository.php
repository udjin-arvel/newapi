<?php
	
namespace App\Repositories;

use App\Models\Tag;
use App\Repositories\Traits\MassSaveTrait;

/**
 * Class TagRepository
 * @package App\Repositories
 */
class TagRepository extends Repository
{
    use MassSaveTrait;
    
    /**
     * @return mixed|string
     */
    protected function getModelClass() {
        return Tag::class;
    }
}