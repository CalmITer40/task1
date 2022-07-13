<?php

namespace App\Http\Controllers;

use App\Traits\RequestDataHelper;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, RequestDataHelper;

    protected function responseJson(
        $payload = [],
        int $code = JsonResponse::HTTP_OK
    )
    {
        return response()->json(['data' => $payload], $code);
    }

    public function responseJsonOk($payload = [])
    {
        return $this->responseJson($payload);
    }

    public function responseJsonCreated($payload = [])
    {
        return $this->responseJson($payload, JsonResponse::HTTP_CREATED);
    }
}
