<?php
declare(strict_types=1);

namespace App\Services\Bytom;

use Bytom\BytomClient;
use Illuminate\Support\Facades\Log;

/**
 * Class Node
 * @package App\Services\Bytom
 *
 *
 */
class Node
{
    private $host;
    private $nodeClient;

    public function __construct()
    {
        $this->host = sprintf(
            "%s://%s:%s/",
            config('services.bytom.proto'),
            config('services.bytom.host'),
            config('services.bytom.port')
        );

        $this->nodeClient = new NodeClient($this->host, config('services.bytom.token'));
    }

    public function host()
    {
        return $this->host;
    }

    public function client()
    {
        return $this->nodeClient;
    }

    public function __call($name, $arguments)
    {
        $name = str_replace('_', '-', $name);

        $response = $this->nodeClient->request($name, $arguments);

        if ( $response['status'] == "fail" ) {
            Log::error("NODE ERROR: " . \json_encode($response));
            throw new \Exception($response['msg']);
        }

        return $response['data'];
    }
}
