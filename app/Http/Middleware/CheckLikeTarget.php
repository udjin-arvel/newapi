<?php

namespace App\Http\Middleware;

use App\Exceptions\TBError;
use Closure;
use Cog\Likeable\Contracts\Likeable as LikeableContract;
use Illuminate\Http\Request;

class CheckLikeTarget
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
	        $className = app()->get('enum')->path('aliases.' . strtolower($request->get('content_type')));
		
	        if (app($className) instanceof LikeableContract) {
			    $request->request->add(['content_type' => $className]);
			    return $next($request);
		    }
	    }
    	
        return response()->json(TBError::getErrorMessageByName(TBError::LIKE_ERROR), 400);
    }
}
