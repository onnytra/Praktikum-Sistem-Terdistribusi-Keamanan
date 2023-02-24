<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class BaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        $response = [
            'success'   => 'True',
            'data'      => $result,
            'message'   => $message,
        ];
        return response()->json($response, 200);
    }
    public function sendError($error, $eerorMessage = [], $code = 404)
    {
        $response = [
            'success'   => 'False',
            'message'   => $error,
        ];
        if (!empty($eerorMessage)) {
            $response['data'] = $eerorMessage;
        }
        return response()->json($response, $code);
    }
}
