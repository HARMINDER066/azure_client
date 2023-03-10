<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendError($error, $errorMessages = [], $code = 200) {
        $response = [
            'code' => 404,
            'message' => $errorMessages,
        ];
        // if (!empty($errorMessages)) {
        //     $response['data'] = $errorMessages;
        // }

        return response()->json($response, $code);
    }
}
