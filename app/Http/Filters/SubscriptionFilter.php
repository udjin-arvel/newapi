<?php

namespace App\Http\Filters;

use Illuminate\Http\Request;

/**
 * Class SubscriptionFilter
 * @package App\Http\Filters
 */
class SubscriptionFilter extends BaseFilter
{
	/**
	 * @var array
	 */
	protected $filtered = [
		'content_type',
		'content_id',
	];
	
	public function __construct(Request $request)
	{
		$request->validate([
			'content_type' => 'string',
			'content_id'   => 'integer',
		]);
		
		parent::__construct($request);
	}
}
