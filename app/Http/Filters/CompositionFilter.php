<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CompositionFilter extends BaseFilter
{
	/**
	 * @var array
	 */
	protected $filtered = [
		'title',
		'type',
	];
	
	public function __construct(Request $request)
	{
		$request->validate([
			'title' => 'string',
			'type'  => 'string',
		]);
		
		parent::__construct($request);
	}
}
