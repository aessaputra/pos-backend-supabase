<?php

namespace App\Services;

use App\DTOs\LoginSuccessDTO;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function loginAndCreateToken(array $credentials): ?LoginSuccessDTO
    {
        if (!Auth::attempt($credentials)) {
            return null;
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return new LoginSuccessDTO(token: $token, user: $user);
    }
}
