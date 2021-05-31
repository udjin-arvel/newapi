<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public $successStatus = 200;
    
    
    /**
     * Отправить успешный json-ответ
     *
     * @param mixed $data
     * @return Response
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
     * @return Response
     */
    public function sendError(string $errorText, int $errorCode = null)
    {
        return response()->json(['success' => false, 'result' => $errorText], $errorCode ?: $this->successStatus);
    }
}
