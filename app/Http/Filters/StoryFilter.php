<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class StoryFilter extends AbstractFilter
{
	/**
	 * @var array
	 */
	protected $filtered = [
		'title',
	];
	
	public function __construct(Request $request)
	{
		$request->validate([
			'title' => 'string',
		]);
		
		parent::__construct($request);
	}
}
