<?php

namespace App\Repositories;

use App\Exceptions\TBError;
use App\Models\Image;
use App\Models\Notion;
use App\Repositories\Interfaces\IWriteableRepository;
use App\Repositories\Traits\BaseRepositoryMethodsTrait;
use App\Repositories\Traits\MassSaveTrait;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * Class NotionRepository
 * @package App\Repositories
 */
class NotionRepository extends Repository implements IWriteableRepository
{
    use MassSaveTrait,
        BaseRepositoryMethodsTrait;
    
	/**
	 * @return mixed|string
	 */
	protected function getModelClass() {
		return Notion::class;
	}
	
	/**
	 * @return array
	 */
	public function all()
	{
        return Notion::orderBy('created_at', 'desc')
            ->load('tag')
            ->get()
            ->sortBy('title');
	}
    
    /**
     * Получить изображения галлереи понятия
     *
     * @param int $id
     * @return array
     */
    public function getNotionGallery(int $id)
    {
        return Image::where('content_type', Image::TYPE_NOTION)
            ->where('content_id', $id)
            ->select(['id', 'path', 'user_id'])
            ->get();
	}
}
