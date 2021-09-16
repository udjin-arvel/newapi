<?php

namespace App\Listeners;

use App\Events\RewardProcessed;
use App\Models\Reward;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;

class RewardListener implements ShouldQueue
{
	/**
	 * @var string|null
	 */
	public $queue = 'listeners';
	
	/**
	 * @var int
	 */
	public $delay = 60;
	
    /**
     * Handle the event.
     *
     * @param  RewardProcessed  $event
     * @return void
     */
    public function handle(RewardProcessed $event)
    {
	    $className = get_class($event->content);
	    $expAmount = Reward::getExpAmountByType(Reward::getTypeByClassName($className));
	    
	    $saved = Reward::create([
		    'content_id'   => $event->content->id,
		    'content_type' => $className,
		    'exp_amount'   => $expAmount,
		    'user_id'      => $event->user->id,
	    ]);
	    
    	if (! ($saved && $event->user->updateExpAmount($expAmount))) {
    		$errorData = json_encode(['className' => $className, 'contentId' => $event->content->id, 'expAmount' => $expAmount]);
		    Log::error("Ошибка при назначении пользователю награды! Данные: {$errorData}.");
	    }
    }
}
