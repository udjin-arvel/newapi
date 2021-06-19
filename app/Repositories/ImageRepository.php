<?php

namespace App\Repositories;

use App\Exceptions\TBError;
use App\Helpers\ImageHelper;
use App\Models\Image;
use App\Repositories\Interfaces\IWriteableRepository;
use App\Repositories\Traits\BaseRepositoryMethodsTrait;

/**
 * Class NotionRepository
 * @package App\Repositories
 */
class ImageRepository extends Repository implements IWriteableRepository
{
    use BaseRepositoryMethodsTrait;
    
    /**
     * @return mixed|string
     */
    protected function getModelClass()
    {
        return Image::class;
    }
    
    /**
     * Сохранить изображение
     *
     * @param array $data
     * @return int
     * @throws TBError
     */
    public function save(array $data): int
    {
        if (empty($data['base64'])) {
            throw new TBError(TBError::CONTENT_NOT_FOUND);
        }
        
        $this->getModel($data['id'])
            ->fillModelFromArray($data);
        
        $this->model->path = ImageHelper::store($data['base64']);
        $this->saveModel();
    
        return $this->model->id;
    }
}
