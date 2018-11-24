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

    public function request(string $endpoint, $params = [])
    {
        $response = $this->client->post($endpoint, [
            'body' => !empty($params) ? \json_encode($params) : "{}",
            'auth' => [
                $this->username, $this->password
            ]
        ]);

        $contents = $response->getBody()->getContents();

        return \json_decode($contents, true);
    }
}
