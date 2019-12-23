<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

class ApiResponseCreator
{
    /**
     * @param mixed $data
     * @return JsonResponse
     */
    public static function responseOk($data = 'success'): JsonResponse
    {
        return new JsonResponse($data);
    }

    /**
     * @param array|string $errors
     * @param int $status
     * @return JsonResponse
     */
    public static function responseError($errors, int $status): JsonResponse
    {
        if (is_string($errors)) {
            $errors = [$errors];
        }

        return new JsonResponse($errors, $status);
    }
}
