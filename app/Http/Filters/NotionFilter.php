<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class NotionFilter extends BaseFilter
{
	/**
	 * @var array
	 */
	protected $filtered = [
		'type',
	];
	
	public function __construct(Request $request)
	{
		$request->validate([
			'type' => 'string',
		]);
		
		parent::__construct($request);
	}
	
	protected function type($value): Builder
	{
		return $this->query->where('type', $value);
	}
}
