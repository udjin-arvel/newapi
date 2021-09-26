<?php

namespace App\Providers;

use App\Enums\Enum;
use Illuminate\Support\ServiceProvider;

class EnumServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
	    $this->app->bind('enum', function () {
		    return new Enum;
	    });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
