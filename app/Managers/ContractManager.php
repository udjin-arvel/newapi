<?php

namespace App\Managers;

use App\Contracts\AbstractContract;
use App\Models\BaseModel;

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
	 * @param BaseModel $model
	 */
	public function viewed(BaseModel $model)
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
	 * @param BaseModel $model
	 */
	public function created(BaseModel $model)
	{
	
	}
	
	/**
	 * @param BaseModel $model
	 */
	public function updated(BaseModel $model)
	{
	
	}
	
	/**
	 * @param BaseModel $model
	 */
	public function deleted(BaseModel $model)
	{
	
	}
}