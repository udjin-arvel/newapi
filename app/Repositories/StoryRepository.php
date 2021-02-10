<?php

namespace App\Repositories;

use App\Models\Story;
use App\Exceptions\TBError;
use Illuminate\Support\Facades\DB;

/**
 * Class StoryRepository
 * @package App\Repositories
 */
class StoryRepository extends Repository
{
	/**
	 * @return mixed|string
	 */
	protected function getModelClass() {
		return Story::class;
	}
	
	public function all()
    {
        return Story::published()
            ->with('fragments')
            ->with('storyComments')
            ->with('tags')
            ->with('notions')
            ->get();
    }
    
    public function one(int $id)
    {
        return Story::where(['id', $id])
            ->with('fragments')
            ->first();
    }
    
    /**
     * Сохранить историю
     *
     * @param array $data
     * @return array
     * @throws TBError
     */
	public function save(array $data)
	{
        DB::beginTransaction();
        
        try {
        
        } catch (TBError $error) {
            DB::rollback();
            throw $error;
        }
        
        DB::commit();
        
        return [];
	}
}
