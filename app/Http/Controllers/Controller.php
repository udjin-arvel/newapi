<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * Class Controller
 * @package App\Http\Controllers
 *
 * @property int $successStatus
 */
class Controller extends BaseController
{
    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;
	
	/**
	 * Отправить успешный json-ответ
	 *
	 * @param mixed $data
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function sendSuccess($data = null)
	{
		return response()->json(['success' => true, 'result' => $data], 200);
	}
}
