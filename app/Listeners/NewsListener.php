<?php

namespace App\Listeners;

use App\Events\NewsProcessed;
use App\Models\News;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewsListener implements ShouldQueue
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
     * @param  NewsProcessed  $event
     * @return void
     */
    public function handle(NewsProcessed $event)
    {
	    News::updateOrCreate([
		    'content_id'   => $event->content->id,
		    'content_type' => $className = get_class($event->content),
		    'action'       => $event->action,
		    'text'         => News::getNewsText($className, $event->content->title, $event->action),
	    ], ['updated_at' => now()]);
    }
}
