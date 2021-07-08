<?php

namespace App\Repositories;

use App\Models\Notion;

/**
 * Class NotionRepository
 * @package App\Repositories
 */
class NotionRepository extends CrudRepository
{
	/**
	 * @return mixed|string
	 */
	protected function getModelClass(): string
    {
		return Notion::class;
	}
	
	/**
	 * @return array
	 */
	public function all()
	{
        return Notion::orderBy('created_at', 'desc')
            ->get()
            ->sortBy('title');
	}
}
