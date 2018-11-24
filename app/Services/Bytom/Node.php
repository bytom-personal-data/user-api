<?php
declare(strict_types=1);

namespace App\Services\Bytom;

use Bytom\BytomClient;

/**
 * Class Node
 * @package App\Services\Bytom
 *
 *
 */
class Node
{
    private $host;
    private $bytomClient;

    public function __construct()
    {
        $this->host = sprintf(
            "%s://%s:%s",
            config('services.bytom.proto'),
            config('services.bytom.host'),
            config('services.bytom.port')
        );

        $this->bytomClient = new BytomClient($this->host, config('services.bytom.token'));
    }

    public function host()
    {
        return $this->host;
    }

    public function client()
    {
        return $this->bytomClient;
    }
}
