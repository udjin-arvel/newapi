<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Class LoreItemFilter
 * @package App\Http\Filters
 */
class LoreItemFilter extends BaseFilter
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
