<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService)
    {
        //
    }

    /**
     * Menangani permintaan login dari pengguna.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        $loginResult = $this->authService->loginAndCreateToken($credentials);

        if (!$loginResult) {
            return response()->json(
                ['message' => 'The provided credentials do not match our records.'],
                Response::HTTP_UNAUTHORIZED
            );
        }

        return response()->json([
            'message' => 'Login successful',
            'token'   => $loginResult->token,
            'user'    => new UserResource($loginResult->user)
        ], Response::HTTP_OK);
    }
}
