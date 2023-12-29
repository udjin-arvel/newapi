<?php

namespace App\Http\Middleware;

use Closure;
use Log;

/**
 * Class PrepareApiData
 * @package App\Http\Middleware
 */
class PrepareApiData
{
    /**
     * Подготовка данных для контроллера
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
	    if (in_array($request->getMethod(), ['POST', 'PUT'])) {
		    $request->request->add(['user_id' => \Auth::id()]);
	    }
    	
        return $next($request);
    }
}
