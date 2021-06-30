<?php
	
namespace App\Repositories;

use App\Models\Tag;

/**
 * Class TagRepository
 * @package App\Repositories
 */
class TagRepository extends Repository
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Tag::class;
    }
}