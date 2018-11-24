<?php
declare(strict_types=1);

namespace App\Services\Data;

use App\Models\Allowance;
use App\Models\AllowanceRequest;
use App\Models\LabelAllowance;
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

    public function makeDataRequest(string $label, string $ownerHash)
    {
        if (!$this->checkAllowanceToReadInLabel($label)) {
            throw new \Exception("Request can'not be sent in this label.");
        }

        $allowanceRequest = AllowanceRequest::create([
            'accessor_hash' => app()->user()->receiver_address,
            'owner_hash' => $ownerHash,
            'label' => $label,
        ]);

        return $allowanceRequest;
    }

    public function getData(string $label, string $ownerHash)
    {
        if (!$this->checkAllowanceToReadInLabel($label)) {
            throw new \Exception("Request can'not be sent in this label.");
        }

        if( !$this->hasAllowance(app()->user(), $ownerHash, $label) ) {
            throw new \Exception("You can't get unaccessed data.");
        }

        $data = Data::where('owner_hash', $ownerHash)
            ->where('label', $label)
            ->all();

        return $data;
    }

    public function checkAllowanceToCreateInLabel($label): bool
    {
        return LabelAllowance::where('accessor_hash', app()->user())
            ->where('label', $label)
            ->where('is_active', true)
            ->where('mode', LabelAllowance::READ_MODE)
            ->count() > 0;
    }

    public function checkAllowanceToReadInLabel($label): bool
    {
        return LabelAllowance::where('accessor_hash', app()->user())
                ->where('label', $label)
                ->where('is_active', true)
                ->where('mode', LabelAllowance::WRITE_MODE)
                ->count() > 0;
    }

    public function hasAllowance($accessorHash, $ownerHash, $label): bool
    {
        return Allowance::where('accessor_hash', $accessorHash)
            ->where('owner_hash', $ownerHash)
            ->where('label', $label)
            ->where('is_active', true)
            ->count() > 0;
    }
}
