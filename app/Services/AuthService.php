<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthService
{
    public function login(array $data)
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return errorResponse('Email atau password salah', null, 401);
        }

        if (property_exists($user, 'isActive') && !$user->isActive) {
            return errorResponse('Akun Anda nonaktif. Hubungi administrator.', null, 403);
        }

        $token = $user->createToken('auth_token', ['*'], now()->addHours(12))->plainTextToken;


        return successResponse([
            'user' => $user,
            'token' => $token
        ], 'Login berhasil');
    }
    public function logout($user)
    {
        $user->currentAccessToken()->delete();
        return successResponse(null, 'Logout berhasil');
    }
}

