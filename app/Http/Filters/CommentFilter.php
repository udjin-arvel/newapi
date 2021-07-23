<?php

namespace App\Http\Filters;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Filter
 * @package App\Http\FIlters
 */
class CommentFilter extends Filter {
    
    protected $filters = [
      'content_id',
      'content_type',
    ];
    
    /**
     * @param Builder $query
     * @return Builder
     */
    public function addFiltersToQuery($query)
    {
        if (! $this->checkFiltersExist()) {
            return $query;
        }
    
        $filters = $this->getRequestFilters();
    
        return $query->where([
            'content_id'   => $filters['content_id'],
            'content_type' => Comment::TYPES[$filters['content_type']],
        ]);
    }
}