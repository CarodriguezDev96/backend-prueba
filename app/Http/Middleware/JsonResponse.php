<?php

namespace App\Http\Middleware;

use Closure;

class JsonResponse
{
    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
    */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        $data = $this->getDataResponse($response);
        return $this->sendResponse($data, $response);
    }

    private function getDataResponse($response)
    {
        $data = $response->original;
        $isException = $response->exception;
        if ($isException) {
            $data = ['message' => 'Internal Server Error', 'statusCode' => 500];
        }

        if (isset($isException->validator)) {
            $data = ['message' => $isException->validator->messages(), 'statusCode' => 422];
        }

        return $data;
    }

    private function sendResponse($data, $response)
    {
        if (gettype($data) == 'array') {
            $statusCode = $data['statusCode'] ?? 200;
            return response()->json([
                'status' => $data['status'] ?? $data[0] ?? false,
                'message' => $data['message'] ?? $data[1] ?? '',
                'data' => $data['data'] ?? $data[2] ?? []
            ], $statusCode);
        }
        return $response;
    }
}
