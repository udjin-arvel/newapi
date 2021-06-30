<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\JsonResponse;
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
    
    protected $successStatus = 200;
    
    /**
     * Отправить успешный json-ответ
     *
     * @param mixed $data
     * @return JsonResponse
     */
    public function sendSuccess($data)
    {
        return response()->json(['success' => true, 'result' => $data], $this->successStatus);
    }
    
    /**
     * Отправить json с ошибкой
     *
     * @param string $errorText
     * @param int|null $errorCode
     * @return JsonResponse
     */
    public function sendError(string $errorText, int $errorCode = null)
    {
        return response()->json(['success' => false, 'error' => $errorText], $errorCode ?: $this->successStatus);
    }
}
