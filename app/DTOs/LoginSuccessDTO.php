<?php

namespace App\DTOs;

use App\Models\User;

class LoginSuccessDTO
{
    public function __construct(
        public readonly string $token,
        public readonly User $user,
    ) {}
}
