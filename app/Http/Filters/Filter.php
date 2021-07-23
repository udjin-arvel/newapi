<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Log;

/**
 * Class Filter
 * @package App\Http\FIlters
 */
abstract class Filter {
    
    /**
     * @var array
     */
    protected $filters = [];
    
    /**
     * @param Builder|\Eloquent $query
     * @return Builder
     */
    abstract public function addFiltersToQuery($query);
    
    /**
     * @return array
     */
    protected function getRequestFilters(): array
    {
        return array_intersect_key(request()->all(), array_flip($this->filters));
    }
    
    /**
     * Проверить существуют ли необходимые фильтры
     * @return bool
     */
    protected function checkFiltersExist(): bool
    {
        if (empty($this->filters)) {
            return false;
        }
        
        if (count($this->getRequestFilters()) === count($this->filters)) {
            return true;
        }
    
        Log::error('Фильтры не найдены. Фильтр: ' . get_class($this));
        
        return false;
    }
}