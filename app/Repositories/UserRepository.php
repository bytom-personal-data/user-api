<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use App\Services\Bytom\Node;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class UserRepository
{
    private const DEFAULT_ACCOUNT = 'main';

    public function create(string $username, string $password): User
    {
        if( User::where('username', $username)->count() > 0 ) {
            //TODO make custom exception
            throw new \Exception("User already registered.");
        }

        /** @var Node $bytom */
        $bytom = resolve(Node::class);
        $key = $bytom->create_key($username, $password);
        $accountAlias = $username . "_" . self::DEFAULT_ACCOUNT;
        $account = $bytom->create_account([$key['xpub']], $accountAlias);
        $receiver = $bytom->create_account_receiver($accountAlias);


        $user = User::create([
            'username' => $username,
            'password' => Hash::make($password),
            'xpub' => $key['xpub'],
            'keyfile' => $key['file'],
            'account_id' => $account['id'],
            'receiver_address' => $receiver['address'],
        ]);

        return $user;
    }

    public function verifyPassword(string $username, string $password): ?User
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            throw new NotFoundResourceException("User not found.");
        }

        if( Hash::check($password, $user->password) ) {
            return $user;
        } else {
            return null;
        }
    }
}
