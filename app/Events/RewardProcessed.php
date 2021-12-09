<?php

namespace App\Events;

use App\Models\BaseModel;
use App\Models\User;
use App\Models\View;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class RewardProcessed
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
	 * @param BaseModel $content
	 * @return void
	 */
    public function __construct(BaseModel $content)
    {
	    $this->content = $content;
	    $this->user    = \Auth::user();
    }
}
