<?php
declare(strict_types=1);

namespace App\Services\Secure;

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;

class Hashing
{
    public function crypt(string $asciiKey, string $data): string
    {
        $key = Key::loadFromAsciiSafeString($asciiKey);
        return Crypto::encrypt($data, $key);
    }

    public function decrypt(string $asciiKey, string $cryptedData): string
    {
        $key = Key::loadFromAsciiSafeString($asciiKey);
        return Crypto::decrypt($cryptedData, $key);
    }
}
