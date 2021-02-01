<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{

    public function sendResponse($data, $message = null) {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response, 200);
    }

    public function sendError($message, $data = [], $code = 404) {
        $response = [
            'success' => false,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response, $code);
    }
    
}
