<?php

namespace App\Http\Filters;

use App\Models\LoreItem;
use App\Models\Notion;
use App\Models\Story;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Log;
use Str;

/**
 * Class BaseFilter
 * @package App\Http\Filters
 */
abstract class BaseFilter
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
	 * @var array
	 */
	protected $models = [
		'story'    => Story::class,
		'notion'   => Notion::class,
		'loreItem' => LoreItem::class,
	];
	
	/**
	 * @var Builder
	 */
	protected $query;
	
	/**
	 * AbstractFilter constructor.
	 * @param Request $request
	 */
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
