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

    /**
     * @param string $username
     * @param string $password
     * @return User
     * @throws \Exception
     */
    public function create(string $username, string $password, int $type = User::TYPE_DEFAULT): User
    {
        if( User::where('username', $username)->count() > 0 ) {
            //TODO make custom exception
            throw new \Exception("User already registered.");
        }

        /** @var Node $bytom */
        $bytom = resolve(Node::class);
        $key = $bytom->client()->createKey($username, $password);
        $accountAlias = $username . "_" . self::DEFAULT_ACCOUNT;
        $account = $bytom->client()->createAccount([$key['xpub']], $accountAlias);
        $receiver = $bytom->client()->createAccountReceiver($accountAlias);


        $user = User::create([
            'username' => $username,
            'password' => Hash::make($password),
            'xpub' => $key['xpub'],
            'keyfile' => $key['file'],
            'account_id' => $account['id'],
            'receiver_address' => $receiver['address'],
            'type' => $type
        ]);

        return $user;
    }

    /**
     * @param string $username
     * @param string $password
     * @return User|null
     */
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
