<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendResponse($data, $message, $extraData=[]) {
        return Response::json($this->makeResponse($data, $message, $extraData));
    }

    private function makeResponse($data = [],$message = 'ok',array $extraData = []) {
        $response = [
            'code' => 200,
            'message' => $message,
            'data' => $data
        ];
        if(!empty($extraData)) {
            $response = array_merge($response, $extraData);
        }
        return $response;
    }
}
