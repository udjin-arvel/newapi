<?php

namespace App\Providers;

use App\Events\NewsProcessed;
use App\Events\RewardProcessed;
use App\Events\ViewProcessed;
use App\Listeners\NewsListener;
use App\Listeners\RewardListener;
use App\Listeners\ViewListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
	protected $listen = [
		ViewProcessed::class   => [ViewListener::class],
		RewardProcessed::class => [RewardListener::class],
		NewsProcessed::class   => [NewsListener::class],
	];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
