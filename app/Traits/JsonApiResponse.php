<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait JsonApiResponse
{
    public function success($data = null, $message = "success", $code = Response::HTTP_OK) 
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    public function error($errors = [], $message = "bad request", $code = Response::HTTP_BAD_REQUEST)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors
        ], $code);
    }
}
