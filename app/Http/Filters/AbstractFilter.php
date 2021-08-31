<?php


namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Str;

class AbstractFilter
{
	/**
	 * @var array
	 */
	protected $filtered = [];
	
	/**
	 * @var Request
	 */
	private $request;
	
	/**
	 * @var Builder
	 */
	protected $query;
	
	public function __construct(Request $request)
	{
		$this->request = $request;
	}
	
	/**
	 * @param Builder $query
	 * @return Builder
	 */
	public function apply(Builder $query)
	{
		$this->query = $query;
		$methods = $this->request->only($this->filtered);
		
		foreach ($methods as $method => $value) {
			$method = Str::camel($method);
			
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
		
		return $this->query;
	}
}
