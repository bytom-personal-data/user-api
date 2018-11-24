<?php
declare(strict_types=1);

namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class ApiAuth
{
    public const AUTH_TOKEN_VALID_DURATION = 180;

    public function __construct()
    {

    }

    public function make(User $user): string
    {
        $token = str_random(32);
        Cache::put($token, $user->id, self::AUTH_TOKEN_VALID_DURATION);
        return $token;
    }

    public function user(string $token): ?User
    {
        if( Cache::has($token) ) {
            return User::where('id', Cache::get($token))->first();
        }

        return null;
    }
}
