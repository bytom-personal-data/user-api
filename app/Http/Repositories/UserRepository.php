<?php
declare(strict_types=1);

namespace App\Http\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function create(string $username, string $password): User
    {
        $user = User::create([
            'username' => $username,
            'password' => Hash::make($password),
        ]);


    }
}
