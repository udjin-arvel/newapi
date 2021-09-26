<?php

namespace App\Http\Middleware;

use App\Facades\Enum;
use Closure;
use Illuminate\Http\Request;

class CheckApiRequestData
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
    	if ($request->get('content_type')) {
		    $alias     = strtolower($request->get('content_type'));
		    $className = Enum::modelByAlias($alias);
		    
		    if ($className) {
			    $request->request->add(['content_type' => $className]);
		    }
	    }
	
	    return $next($request);
    }
}
