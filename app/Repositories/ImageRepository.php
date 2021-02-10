<?php

namespace App\Repositories;

use App\Exceptions\TBError;
use App\Helpers\Assert;
use App\Models\Image;
use Illuminate\Support\Facades\Log;

/**
 * Class NotionRepository
 * @package App\Repositories
 */
class ImageRepository extends Repository
{
    /**
     * @return mixed|string
     */
    protected function getModelClass()
    {
        return Image::class;
    }
    
    public function one(int $id)
    {
        // TODO: Implement one() method.
    }
    
    public function all()
    {
        // TODO: Implement all() method.
    }
    
    /**
     * Проверить файлы и удалить старый экземпляр в случае, если получен новый
     *
     * @param string $newFile
     * @param string $oldFile
     * @return string
     */
    public static function getLatestImage(string $newFile, string $oldFile): string
    {
        if ($oldFile !== $newFile) {
            if ($oldFile && !Image::deleteImage($oldFile)) {
                Log::warning("Изображение ({$oldFile}) не было удалено.");
            }
        
            if ($newFile) {
                return Image::storedImageFromBase64($newFile);
            }
        }
        
        return '';
    }
    
    /**
     * Сохранить изображение
     *
     * @param $data
     * @return Image
     * @throws TBError
     */
    public function save(array $data)
    {
        Assert::keysExist(['base64', 'content_id', 'content_type'], $data, TBError::DATA_NOT_FOUND);
        
        $model = new Image;
        
        $model->content_id   = $data['content_id'];
        $model->content_type = $data['content_type'];
        $model->user_id      = $this->user->id;
        
        if ($data['base64']) {
            $model->path = Image::storedImageFromBase64($data['base64']);
        }
        
        if (!$model->save()) {
            throw new TBError(TBError::SAVE_ERROR);
        }
    
        return $model;
    }
    
    /**
     * @param int $id
     * @return Image
     * @throws TBError
     */
    public function delete(int $id)
    {
        /**
         * @type Image $model
         */
        $model = parent::delete($id);
    
        if (!Image::deleteImage($model->path)) {
            Log::warning("Изображение ({$model->path}) не было удалено.");
        }
    
        return $model;
    }
}
