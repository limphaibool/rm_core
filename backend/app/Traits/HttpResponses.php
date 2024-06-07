<?php

namespace App\Traits;

use App\Enums\ResponseStatus;
use Symfony\Component\HttpFoundation\Response;

trait HttpResponses
{
    protected function success($message = 'Success', $data = null)
    {
        return response()->json([
            'status' => ResponseStatus::SUCCESS->value,
            'message' => $message,
            'data' => $data
        ], Response::HTTP_OK);
    }

    protected function error($status = ResponseStatus::ERROR->value, $message = 'Error', $data = null)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], Response::HTTP_BAD_REQUEST);
    }
    protected function unauthenticated()
    {
        return response()->json([
            'status' => ResponseStatus::UNAUTHENTICATED->value,
            'message' => 'Unauthenticated',
            'data' => null
        ], Response::HTTP_UNAUTHORIZED);
    }
    protected function unauthorized()
    {
        return response()->json([
            'status' => ResponseStatus::UNAUTHORIZED->value,
            'message' => 'Unauthorized',
            'data' => null
        ], Response::HTTP_FORBIDDEN);
    }
}
