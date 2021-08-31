<?php

namespace App\Contracts;

use App\Models\AbstractModel;

/**
 * Class AbstractContract
 * @package App\Contracts
 */
class AbstractContract
{
	/**
	 * Доступные контракту методы
	 */
	const METHOD_ONE    = 'one';
	const METHOD_CREATE = 'create';
	const METHOD_UPDATE = 'update';
	const METHOD_DELETE = 'delete';
	
	/**
	 * @var AbstractModel
	 */
	protected $model;
	
	/**
	 * @var array
	 */
	protected $methods;
	
	/**
	 * Выполнить контракт
	 *
	 * @param string $method
	 * @param mixed $params
	 */
	public function apply(string $method, $params)
	{
		if (in_array($method, $this->methods) && method_exists($this, $method)) {
			$this->{$method}($params);
		}
	}
}