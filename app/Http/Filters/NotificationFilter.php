<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Class NotificationFilter
 * @package App\Http\Filters
 */
class NotificationFilter extends BaseFilter
{
	/**
	 * @var array
	 */
	protected $filtered = [
		'content_type',
	];
	
	/**
	 * NotificationFilter constructor.
	 * @param Request $request
	 */
	public function __construct(Request $request)
	{
		$request->validate([
			'content_type' => 'string',
		]);
		
		parent::__construct($request);
	}
	
	/**
	 * @param $value
	 * @return Builder
	 */
	protected function contentType($value): Builder
	{
		return $this->query->where('content_type', $value);
	}
}
