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

        if (!$this->checkAllowanceToCreateInLabel($label)) {
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

    public function makeDataRequest(string $label, string $owner_hash)
    {
        if (!$this->checkAllowanceToReadInLabel($label)) {
            throw new \Exception("Request can'not be sent in this label.");
        }

        //TODO make new AllowanceRequest
    }

    public function getData(string $label, string $owner_hash)
    {
        if (!$this->checkAllowanceToReadInLabel($label)) {
            throw new \Exception("Request can'not be sent in this label.");
        }

        //TODO check setted allowance

        $data = Data::where('owner_hash', $owner_hash)
            ->all();

        return $data;
    }

    public function checkAllowanceToCreateInLabel($label): bool
    {
        return true;
    }

    public function checkAllowanceToReadInLabel($label): bool
    {
        return true;
    }
}
