<?php

namespace App\Http\Filters;

use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TagFilter extends BaseFilter
{
	/**
	 * @var array
	 */
	protected $filtered = [
		'used',
	];
	
	public function __construct(Request $request)
	{
		$request->validate([
			'used' => 'boolean',
		]);
		
		parent::__construct($request);
	}
	
	protected function used($value): Builder
	{
		if ($value) {
			$usedTagIds = DB::table('taggables')
				->select('tag_id')
				->distinct()
				->get()
				->pluck('tag_id')
				->toArray();
			
			return $this->query->whereIn('id', $usedTagIds);
		}
		
		return $this->query;
	}
}
