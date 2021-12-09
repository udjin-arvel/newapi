<?php

namespace App\Events;

use App\Models\BaseModel;
use App\Models\User;
use App\Models\View;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class NewsProcessed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
	
	/**
	 * @var View
	 */
	public $content;
	
	/**
	 * @var User
	 */
	public $user;
	
	/**
	 * @var string
	 */
	public $action;
	
	/**
	 * Create a new event instance.
	 *
	 * @param BaseModel $content
	 * @param string $action
	 */
	public function __construct(BaseModel $content, string $action)
	{
		$this->content = $content;
		$this->action  = $action;
		$this->user    = \Auth::user();
	}
}
