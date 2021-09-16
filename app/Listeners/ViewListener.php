<?php

namespace App\Listeners;

use App\Events\ViewProcessed;
use App\Models\View;
use Illuminate\Contracts\Queue\ShouldQueue;

class ViewListener implements ShouldQueue
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
     * @param  ViewProcessed  $event
     * @return void
     */
    public function handle(ViewProcessed $event)
    {
	    View::updateOrCreate([
		    'content_id'   => $event->content->id,
		    'content_type' => get_class($event->content),
		    'user_id'      => $event->user->id,
	    ], ['updated_at' => now()]);
    }
}
