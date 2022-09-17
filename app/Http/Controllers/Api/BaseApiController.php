<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class BaseApiController extends Controller
{
    /**
     * Create a new JSON success response
     *
     * @param mixed $data
     * @param integer $status
     * @return \Illuminate\Http\JsonResponse
     */
    protected function successResponse(mixed $data, int $status = 200, string $message = "Successful request"){
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $status);
    }

    /**
     * Create a new JSON failed response
     *
     * @param integer $status
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorResponse(int $status = 400, string $message = "There was an error in the request"){
        return response()->json([
            'success' => false,
            'message' => __($message),
        ], $status);
    }
}
