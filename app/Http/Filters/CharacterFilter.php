<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CharacterFilter extends BaseFilter
{
    /**
     * @var array
     */
    protected $filtered = [
        'is_public',
    ];
    
    public function __construct(Request $request)
    {
        $request->validate([
            'is_public' => 'bool',
        ]);
        
        parent::__construct($request);
    }
    
    protected function is_public($value): Builder
    {
        return $this->query->where('is_public', $value);
    }
}
