<?php

namespace App\Services;

class ResponseServices
{

    public static function success($data, $message = 'success')
    {
        return response()->json([
            'data' => $data,
            'message' => $message
        ], 200);
    }

    public static function fail($message = 'fail')
    {
        return response()->json([
            'message' => $message
        ], 422);
    }
}
