<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Class ShortFilter
 * @package App\Http\Filters
 */
class ShortFilter extends BaseFilter
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
			'title' => 'string',
		]);
		
		parent::__construct($request);
	}
}
