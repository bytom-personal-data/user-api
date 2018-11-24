<?php
declare(strict_types=1);

namespace App\Services\Data;

use Symfony\Component\VarDumper\Cloner\Data;

class Storing
{
    public function __construct()
    {
    }

    public function add(string $label, string $data, string $ownerHash = null)
    {
        $ownerHash = $ownerHash ?? app()->user()->receiver_address;

        if (!$this->checkAllowanceToLabel($label)) {
            throw new \Exception("Maker not allowed to create data with this label");
        }

        $data = Data::create([
            'label' => $label,
            'maker_hash' => app()->user()->receiver_address,
            'owner_hash' => $ownerHash,
            'data' => $data,
        ]);

        return $data;
    }

    public function checkAllowanceToLabel($label): bool
    {
        return true;
    }
}
