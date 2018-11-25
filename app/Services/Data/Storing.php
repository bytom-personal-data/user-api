<?php
declare(strict_types=1);

namespace App\Services\Data;

use App\Models\Allowance;
use App\Models\AllowanceRequest;
use App\Models\LabelAllowance;
use Illuminate\Support\Facades\DB;
use App\Models\Data;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Storing
{
    public function __construct()
    {
    }

    public function add(string $label, string $data, string $ownerHash = null)
    {
        $ownerHash = $ownerHash ?? request()->user()->receiver_address;

        if (!$this->checkAllowanceToCreateInLabel($label)) {
            throw new \Exception("Maker not allowed to create data with this label");
        }

        $data = Data::create([
            'label' => $label,
            'maker_hash' => request()->user()->receiver_address,
            'owner_hash' => $ownerHash,
            'data' => $data,
        ]);

        return $data;
    }

    public function makeDataRequest(array $labels, string $ownerHash)
    {
        $allowanceRequest = [];

        DB::transaction(function () use ($labels, $ownerHash) {
            foreach ($labels as $label) {
                if (!$this->checkAllowanceToReadInLabel($label)) {
                    throw new \Exception("Request can'not be sent to label $label.");
                }

                $allowanceRequest[] = AllowanceRequest::create([
                    'hash' => str_random(32),
                    'accessor_hash' => request()->user()->receiver_address,
                    'owner_hash' => $ownerHash,
                    'label' => $label,
                ]);
            }
        });

        return $allowanceRequest;
    }

    public function getData(array $labels, string $ownerHash)
    {
        foreach( $labels as $label ) {
            if (!$this->checkAllowanceToReadInLabel($label)) {
                throw new \Exception("Data can'not be getted for this label.");
            }

            if (!$this->hasAllowance(request()->user()->receiver_address, $ownerHash, $label)) {
                throw new \Exception("You can't get unaccessed data.");
            }
        }

        $data = Data::where('owner_hash', $ownerHash)
            ->whereIn('label', $labels)
            ->get();

        return $data;
    }

    public function checkAllowanceToCreateInLabel($label): bool
    {
        //FOR TEST
        return true;

        return LabelAllowance::where('accessor_hash', request()->user()->receiver_address)
            ->where('label', $label)
            ->where('is_active', true)
            ->where('mode', LabelAllowance::READ_MODE)
            ->count() > 0;
    }

    public function checkAllowanceToReadInLabel($label): bool
    {
        return true;

        return LabelAllowance::where('accessor_hash', request()->user()->receiver_address)
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
            ->count() > 0 ||
            $ownerHash == $accessorHash;
    }

    public function getAllRequests($status = AllowanceRequest::NOT_ACCESSED)
    {
        return AllowanceRequest::where('owner_hash', request()->user()->receiver_address)
            ->where('status', $status)
            ->get();
    }

    public function confirmRequest($allowanceHash): ?Allowance {
        /** @var AllowanceRequest $request */
        $request = AllowanceRequest::where('hash', $allowanceHash)->get();

        if($request) {
            $request->status = AllowanceRequest::ACCESSED;
            $request->save();

            return Allowance::create([
                'accessor_hash' => $request->accessor_hash,
                'owner_hash' => $request->owner_hash,
                'label' => $request->label,
            ]);
        } else {
            throw new NotFoundHttpException("Allowance request not found.");
        }
    }
}
