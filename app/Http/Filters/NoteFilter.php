<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class NoteFilter extends AbstractFilter
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
			'importance' => 'integer',
		]);
		
		parent::__construct($request);
	}
	
	protected function importance($value): Builder
	{
		return $this->query->where('importance', '>=', $value);
	}
}
