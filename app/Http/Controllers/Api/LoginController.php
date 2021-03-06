<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(request $request)
    {
        $creds = $request->only(['email', 'password']);

        if( !$token = auth()->attempt($creds) ) {
            return response()->json([
                'error' => true,
                'message' => 'Incorrect login/password',
                ], 401);
        }
        return response()->json(['token' => $token]);
    }

    public function refresh()
    {
        try {
            $token = auth()->refresh();
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 401);
        }

        return response()->json(['token' => $token]);
    }
}
