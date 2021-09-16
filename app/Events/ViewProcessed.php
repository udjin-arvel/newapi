<?php

namespace App\Events;

use App\Models\AbstractModel;
use App\Models\User;
use App\Models\View;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ViewProcessed
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
	 * Create a new event instance.
	 *
	 * @param AbstractModel $content
	 * @return void
	 */
	public function __construct(AbstractModel $content)
	{
		$this->content = $content;
		$this->user    = \Auth::user();
	}
}
