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
		$this->request = $this->prepareRequestData($request);
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
	
	/**
	 * Подготовка данных для контроллера: тип в виде строки, content_type в виде App\Models\Some и т.п.
	 * @param Request $request
	 * @return Request
	 */
	protected function prepareRequestData(Request $request): Request
	{
		if ($request->exists('content_type')) {
			$contentType = config("tb.alias_model.{$request->get('content_type')}", '');
			$request->request->add(['content_type' => $contentType]);
			
			if (empty($contentType)) {
				Log::error("Не найден alias для content_type={$request->get('content_type')}");
			}
		}
		
		if (in_array($request->getMethod(), ['POST', 'PUT'])) {
			$request->request->add(['user_id' => \Auth::id()]);
		}
		
		return $request;
	}
}
