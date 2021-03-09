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
use Illuminate\Http\Exceptions\HttpResponseException;

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
        } catch (Exception $e) {
            if ($e instanceof TokenInvalidException) {
                $error = 'O token de autenticação informado é inválido';
            } elseif ($e instanceof TokenExpiredException) {
                $error = 'O token de autenticação informado está expirado';
            } else {
                $error = 'O token de autenticação não foi informado';
            }

            throw new HttpResponseException(
                response()->json(
                    $error,
                    JsonResponse::HTTP_UNPROCESSABLE_ENTITY
                )
            );
        }

        return $next($request);
    }
}
