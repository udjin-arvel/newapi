<?php

namespace App\Repositories;

use App\Models\Story;
use App\Exceptions\TBError;
use App\Repositories\Interfaces\IWriteableRepository;
use App\Repositories\Traits\BaseRepositoryMethodsTrait;
use Illuminate\Database\Query\Builder;

/**
 * Class StoryRepository
 * @package App\Repositories
 *
 * @property Story $model
 */
class StoryRepository extends Repository implements IWriteableRepository
{
    use BaseRepositoryMethodsTrait;
    
    /**
     * Историй на страницу
     */
    const STORIES_IN_PAGE = 10;
    
	/**
	 * @return mixed|string
	 */
	protected function getModelClass() {
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
