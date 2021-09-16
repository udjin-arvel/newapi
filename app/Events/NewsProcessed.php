<?php

namespace App\Events;

use App\Models\AbstractModel;
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
	 * @param AbstractModel $content
	 * @param string $action
	 */
	public function __construct(AbstractModel $content, string $action)
	{
		$this->content = $content;
		$this->action  = $action;
		$this->user    = \Auth::user();
	}
}
