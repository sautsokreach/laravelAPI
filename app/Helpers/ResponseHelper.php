<?php

if (!function_exists('apiResponse')) {
    function apiResponse($data = null, $message = '', $status = 200)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $status);
    }
}