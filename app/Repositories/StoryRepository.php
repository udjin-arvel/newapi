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
	 * @return mixed|string
	 */
	protected function getModelClass() {
		return Story::class;
	}
	
	public function all()
    {
        return Story::published()
            ->byOwn()
            ->get();
    }
    
    public function one(int $id)
    {
        return Story::findOrFail($id)
            ->load(['fragments', 'remarks', 'tags', 'notions'])
            ->first();
    }
    
    /**
     * Сохранить историю
     *
     * @param array $data
     * @return int
     * @throws TBError
     */
	public function save(array $data): int
	{
        $this->getModel($data['id'])
            ->fillModelFromArray($data)
            ->saveModel();
        
        return $this->model->id;
	}
}
