<?php


namespace App\Traits;

use Illuminate\Http\JsonResponse;


trait ApiTrait
{
    protected function success($data, string $message = null, int $code = 200): JsonResponse
    {
        return response()->json($data ?? $message, $code);
    }

    protected function error(string $errorMessage = null, $errorCode = null, int $httpStatusCode = 403, $additionalData = []): JsonResponse
    {
        $response = [];

        if ($additionalData) $response = $additionalData;

        if ($errorMessage) $response['errorMessage'] = $errorMessage;
        if ($errorCode) $response['errorCode'] = $errorCode;

        return response()->json($response, $httpStatusCode);
    }

}
