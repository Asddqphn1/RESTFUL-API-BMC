<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Bidan;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
   public function login(Request $request)
{
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    $credentials = $request->only('username', 'password');
    $user = null;
    $userType = null;

    // Cek pasien
    $pasien = Pasien::where('username', $credentials['username'])->first();
    if ($pasien && Hash::check($credentials['password'], $pasien->password)) {
        $user = $pasien;
        $userType = 'pasien';
    }

    // Cek bidan
    if (!$user) {
        $bidan = Bidan::where('username', $credentials['username'])->first();
        if ($bidan && Hash::check($credentials['password'], $bidan->password)) {
            $user = $bidan;
            $userType = 'bidan';
        }
    }

    if (!$user) {
        return response()->json(['error' => 'Username atau password salah'], 401);
    }

    // 🔹 Tentukan klaim sesuai tipe user
    if ($userType === 'pasien') {
        $customClaims = [
            'no_reg' => (string) $user->no_reg,
            'username' => $user->username,
            'nama' => $user->nama
        ];
    } else {
        $customClaims = [
            'id' => (string) $user->id,
            'username' => $user->username,
            'nama' => $user->nama
        ];
    }

    // 🔹 Generate token sesuai guard userType
    $token = auth($userType)->claims($customClaims)->fromUser($user);

    // 🔹 Simpan token di cookie (1 hari)
    $cookie = cookie('token', $token, 60 * 24);

    // 🔹 Response JSON sesuai tipe user
    $responseData = [
        'message' => 'Login berhasil',
        $userType => $userType === 'pasien'
            ? [
                'no_reg' => $user->no_reg,
                'username' => $user->username,
                'nama' => $user->nama
            ]
            : [
                'id' => $user->id,
                'username' => $user->username,
                'nama' => $user->nama
            ]
    ];

    return response()->json($responseData)->withCookie($cookie);
}



    public function logout()
    {
        $cookie = Cookie::forget('token');
        return response()->json(['message' => 'Logout berhasil'])->withCookie($cookie);
    }

    public function profile(Request $request)
    {
        return response()->json([
            'user' => $request->auth_user,
            'user_type' => $request->auth_type
        ]);
    }
}
