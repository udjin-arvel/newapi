<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Log;

/**
 * Class PaymentController
 * @package App\Http\Controllers\Api
 *
 * @property mixed $input
 */
class PaymentController extends Controller
{
    /**
     */
    public function confirm(Request $request)
    {
        Log::info('Robokassa request data: ' . json_encode($request->all()));
        return response()->json(['OK' => $request->InvId]);
    }
}
