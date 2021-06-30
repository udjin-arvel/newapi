<?php

namespace App\Models\Traits;

use App\Models\Book;
use App\Models\Series;
use App\Models\Story;

/**
 * Trait ChapteredTrait
 * @package App\Models\Traits
 *
 * @property Series|Book $model
 */
trait ChapteredTrait {
    /**
     * Получить главы
     *
     * @param int $id
     * @param string $keeperType
     * @return array
     */
    public function getChapters(int $id, string $keeperType): array
    {
        $this->take($id);
        
        return [
            'id'       => $this->model->id,
            'title'    => $this->model->title,
            'chapters' => Story::published()
                ->byKeeperId($keeperType, $this->model->id)
                ->get(),
        ];
    }
}