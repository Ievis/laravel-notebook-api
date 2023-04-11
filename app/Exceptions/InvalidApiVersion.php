<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class InvalidApiVersion extends Exception
{
    public static function throw(): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => 'Invalid api version' . ' use ' . config('app.api_version') . ' instead'
        ]);
    }
}
