<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtWiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof TokenInvalidException) {
               return response()->json([
                   'error' => true,
                   'message' => 'Token is Invalid'
               ]);
            } else if ($e instanceof TokenExpiredException) {
                return response()->json([
                    'error' => true,
                    'message' => 'Token is Expired'
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'Token is not found'
                ], 401);
            }
        }

        return $next($request);
    }
}
