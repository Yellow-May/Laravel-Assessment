<?php

namespace App\Helpers;

use function PHPUnit\Framework\isEmpty;

class AppHelpers
{
    public static function init()
    {
        return new AppHelpers();
    }

    public static function api_response($data, $status = 200, $message = "success")
    {
        return response()->json([
            "message" => $message,
            "data" => $data
        ], $status);
    }
}
