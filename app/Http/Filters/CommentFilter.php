<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CommentFilter extends AbstractFilter
{
	/**
	 * @var array
	 */
	protected $filtered = [
		'content_id',
		'content_type',
	];
	
	public function __construct(Request $request)
	{
		$request->validate([
			'content_id'   => 'required|integer',
			'content_type' => 'required|string',
		]);
		
		parent::__construct($request);
	}
	
	protected function contentId($value): Builder
	{
		return $this->query->where('content_id', $value);
	}
	
	protected function contentType($value): Builder
	{
		if (isset($this->models[$value])) {
			return $this->query->where('content_type', $this->models[$value]);
		}
		
		return $this->query;
	}
}
