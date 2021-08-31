<?php

namespace App\Managers;

use App\Contracts\AbstractContract;
use App\Models\AbstractModel;

class ContractManager {
	/**
	 * @var array
	 */
	protected $contracts = [];
	
	/**
	 * ContractManager constructor.
	 * @param array $contracts
	 */
	public function __construct(array $contracts)
	{
		$this->contracts = collect($contracts)->map(function ($contractClass) {
			return new $contractClass;
		});
	}
	
	/**
	 * @param AbstractModel $model
	 */
	public function viewed(AbstractModel $model)
	{
		$this->contracts->each(function ($contract) use ($model) {
			/**
			 * @var AbstractContract $contract
			 */
			$contract->apply(AbstractContract::METHOD_ONE, [
				'model' => $model,
				'viewer_id' => \Auth::id(),
			]);
		});
	}
	
	/**
	 * @param AbstractModel $model
	 */
	public function created(AbstractModel $model)
	{
	
	}
	
	/**
	 * @param AbstractModel $model
	 */
	public function updated(AbstractModel $model)
	{
	
	}
	
	/**
	 * @param AbstractModel $model
	 */
	public function deleted(AbstractModel $model)
	{
	
	}
}