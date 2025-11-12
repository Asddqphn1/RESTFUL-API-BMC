<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\Bidan;
use App\Models\Pasien;

class JwtCookieMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Ambil token dari cookie atau Authorization Bearer
        $token = $request->cookie('token') ?: $request->bearerToken();

        if (!$token) {
            return response()->json(['message' => 'Token not provided'], 401);
        }

        try {
            // Ambil payload token
            $payload = JWTAuth::setToken($token)->getPayload();
            $userId = $payload->get('sub');

            // Coba cari di tabel Bidan dulu
            $user = Bidan::find($userId);

            // Kalau gak ketemu, coba cari di tabel Pasien
            if (!$user) {
                $user = Pasien::find($userId);
            }

            // Kalau tetap gak ada, token invalid
            if (!$user) {
                return response()->json(['message' => 'Invalid token'], 401);
            }

            // Simpan user ke request
            $request->merge([
                'auth_user' => $user,
            ]);

        } catch (JWTException $e) {
            return response()->json(['message' => 'Token error: '.$e->getMessage()], 401);
        }

        return $next($request);
    }
}
