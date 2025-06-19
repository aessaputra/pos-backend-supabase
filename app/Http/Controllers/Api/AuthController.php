<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        $token = $this->authService->loginAndCreateToken($credentials);

        if (!$token) {
            return response()->json(
                ['message' => 'The provided credentials do not match our records.'],
                Response::HTTP_UNAUTHORIZED
            );
        }

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'Bearer',
        ], Response::HTTP_OK);
    }
}
