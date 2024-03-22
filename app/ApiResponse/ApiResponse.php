<?php

namespace App\ApiResponse;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Trait ApiResponser
 *
*/
trait ApiResponse
{
    /**
     * @param string|array $message
     * @param array $data
     * @param int $statusCode
     *
     * @return JsonResponse
    */
    protected function baseResponse(
        string $message,
        array $data,
        array $errors,
        int $statusCode
    ): JsonResponse
    {
        return response()->json([
            'message' =>  $message,
            'data' => $data,
            'errors' => $errors,
        ], $statusCode);
    }

    /**
     * @param string $message
     * @param array $data
     *
     * @return JsonResponse
     */
    protected function successResponse(string $message = "", array $data = [], $errors = []): JsonResponse
    {
        return $this->baseResponse(
            $message,
            $data,
            $errors,
            Response::HTTP_OK
        );
    }

    /**
     * @param string|array $message
     * @param array $data
     *
     * @return JsonResponse
     */
    protected function errorResponse(string $message = "", $errors = [], array $data = []): JsonResponse
    {
        return $this->baseResponse(
            $message,
            $data,
            $errors,
            Response::HTTP_BAD_REQUEST
        );
    }
}