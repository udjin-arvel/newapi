<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Resources\Json\JsonResource;
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
	 * @param int $code
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function sendSuccess($data, int $code = 200)
	{
		return (new JsonResource(collect($data)))
			->response()
			->setStatusCode($code);
	}
}
