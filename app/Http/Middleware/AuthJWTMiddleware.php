<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class AuthJWTMiddleware extends BaseMiddleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return JsonResponse
     */
    public function handle(Request $request, Closure $next): JsonResponse
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (Exception $exception) {
            if ($exception instanceof TokenInvalidException) {
                return response()->json(['status' => 'Token is invalid']);
            } elseif ($exception instanceof TokenExpiredException) {
                return response()->json(['status' => 'Token is expired']);
            } else {
                return response()->json(['status' => 'Token not found']);
            }
        }

        return $next($request);
    }
}
