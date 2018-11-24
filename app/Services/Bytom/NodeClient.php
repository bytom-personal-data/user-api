<?php
declare(strict_types=1);

namespace App\Services\Bytom;

use GuzzleHttp\Client;

class NodeClient
{
    private $client;
    private $username;
    private $password;

    public function __construct($uri, $auth)
    {
        $auth = explode(':', $auth);
        $this->username = $auth[0];
        $this->password = $auth[1];

        $this->client = new Client([
            'base_uri' => $uri
        ]);
    }

    public function createKey(string $username, string $password): array
    {
        return $this->request('create-key', ['alias' => $username, 'password' => $password]);
    }

    public function createAccount(array $xpubs, string $alias, int $quorum = 1): array
    {
        return $this->request('create-account', ['root_xpubs' => $xpubs, 'alias' => $alias, 'quorum' => $quorum]);
    }

    public function createAccountReceiver(string $alias)
    {
        return $this->request('create-account-receiver', ['account_alias' => $alias]);
    }

    public function request(string $endpoint, $params = [])
    {
        $response = $this->client->post($endpoint, [
            'body' => !empty($params) ? \json_encode($params) : "{}",
            'auth' => [
                $this->username, $this->password
            ]
        ]);

        $contents = $response->getBody()->getContents();
        $contents = \json_decode($contents, true);

        if ($contents['status'] == 'success') {
            return $contents['data'];
        } else {
            throw new \Exception($contents['msg']);
        }
    }
}
