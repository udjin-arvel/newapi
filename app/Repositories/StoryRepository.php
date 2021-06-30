<?php

namespace App\Repositories;

use App\Models\Story;

/**
 * Class StoryRepository
 * @package App\Repositories
 *
 * @property Story $model
 */
class StoryRepository extends CrudRepository
{
    /**
     * Историй на страницу
     */
    const STORIES_IN_PAGE = 10;
    
	/**
	 * @return mixed|string
	 */
	protected function getModelClass(): string
    {
		return Story::class;
	}
	
	public function all()
    {
        return Story::published()
            ->with([
                'fragments',
                'notions',
                'remarks',
                'tags',
            ])
            ->byOwn()
            ->paginate(self::STORIES_IN_PAGE)
        ;
    }
    
    public function one(int $id)
    {
        return Story::findOrFail($id)
            ->with([
                'fragments',
                'remarks',
                'tags',
                'notions'
            ])
            ->first();
    }
}
