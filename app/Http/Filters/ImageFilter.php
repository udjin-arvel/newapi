<?php

namespace App\Http\Filters;

use Illuminate\Http\Request;

class ImageFilter extends AbstractFilter
{
	/**
	 * @var array
	 */
	protected $filtered = [
		'title',
		'content_id',
		'content_type',
	];
	
	public function __construct(Request $request)
	{
		$request->validate([
			'title'        => 'string',
			'content_id'   => 'int',
			'content_type' => 'string',
		]);
		
		parent::__construct($request);
	}
}
