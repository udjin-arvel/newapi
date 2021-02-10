<?php

namespace App\Repositories;

use App\Exceptions\TBError;
use App\Models\Image;
use App\Models\Notion;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * Class NotionRepository
 * @package App\Repositories
 */
class NotionRepository extends Repository
{
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
	    $models = Notion::orderBy('created_at', 'desc')
            ->get();
	    
        return collect($models)->sortBy('title')->values();
	}
    
    /**
     * @param int $id
     * @return mixed|void
     * @throws TBError
     */
	public function one(int $id)
    {
        return $this->getModel($id);
    }
    
    /**
     * @param array $data
     * @return Notion
     * @throws TBError
     */
    public function save(array $data)
    {
        /**
         * @type Notion $model
         */
        $model = $this->getModel($data['id']);
    
        $model->title   = $data['title'];
        $model->type    = $data['type'];
        $model->text    = $data['text'];
        $model->user_id = $this->user->id;
    
        if ($model->main_image !== $data['main_image']) {
            if ($model->main_image && !Image::deleteImage($model->main_image)) {
                Log::warning("Изображение ({$model->main_image}) не было удалено.");
            }
    
            if ($data['main_image']) {
                $model->main_image = Image::storedImageFromBase64($data['main_image']);
            }
        }
    
        if (!$model->save()) {
            throw new TBError(TBError::SAVE_ERROR);
        }
    
        return $model;
	}
    
    /**
     * Получить изображения галлереи понятия
     *
     * @param int $id
     * @return array
     * @throws TBError
     */
    public function getNotionGallery($id)
    {
        if (empty($id)) {
            throw new TBError(TBError::NOTION_NOT_FOUND);
        }
        
        return Image::where('content_type', Image::TYPE_NOTION)
            ->where('content_id', $id)
            ->select(['id', 'path', 'user_id'])
            ->get();
	}
    
    /**
     * @param int $id
     * @return Model
     * @throws TBError
     */
    public function delete(int $id)
    {
        /**
         * @type Model $model
         */
        $model = parent::delete($id);
        
        if ($model->main_image) {
            Storage::disk('public')->delete($model->main_image);
        }
        
        return $model;
	}
}
