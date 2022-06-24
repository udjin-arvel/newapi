<?php

namespace App\Http\Middleware;

use App\Capacitors\AliasCapacitor;
use Closure;
use Log;

/**
 * Class PrepareApiData
 * @package App\Http\Middleware
 */
class PrepareApiData
{
    /**
     * Подготовка данных для контроллера: тип в виде строки, content_type в виде App\Models\Some и т.п.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
	    if ($request->exists('content_type') && is_string($request->get('content_type'))) {
		    $contentType = AliasCapacitor::getClassByAlias($request->get('content_type'));
		    $request->request->add(['content_type' => $contentType]);
		
		    if (empty($contentType)) {
			    Log::error("Не найден alias для content_type={$request->get('content_type')}");
		    }
	    }
	
	    if ($request->exists('tags')) {
	    	$tags = collect($request->get('tags'))->pluck('id')->toArray();
		    $request->request->add(compact('tags'));
	    }
	
	    if (in_array($request->getMethod(), ['POST', 'PUT'])) {
		    $request->request->add(['user_id' => \Auth::id()]);
	    }
    	
        return $next($request);
    }
}
