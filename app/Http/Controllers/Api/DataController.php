<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Constants\Labels;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConfirmAllowanceRequest;
use App\Http\Requests\DataAdd as DataAddRequest;
use App\Http\Requests\DataGet as DataGetRequest;
use App\Http\Resources\Data as DataResource;
use App\Services\Data\Storing;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function add(DataAddRequest $request, Storing $storing)
    {
        return new DataResource($storing->add($request->label, $request->data, $request->owner_hash));
    }

    public function labels()
    {
        return Labels::getLabels();
    }

    public function createRequestByLabel(DataGetRequest $request, Storing $storing)
    {
        return $storing->makeDataRequest($request->labels, $request->owner_hash);
    }

    public function getAllRequestsByLabel(Request $request, Storing $storing)
    {
        if ($request->get('labels')) {
            return $storing->getAllRequests($request->labels);
        } else {
            throw new \Exception("Labels not exists in query.");
        }
    }

    public function getDataByLabels(Request $request, Storing $storing)
    {
        if ($request->get('labels')) {
            $ownerHash = $request->get('owner_hash') ?? $request->user()->receiver_address;
            return DataResource::collection($storing->getData($request->get('labels'), $ownerHash));
        } else {
            throw new \Exception("Labels not exists in query.");
        }
    }

    /**
     * @param ConfirmAllowanceRequest $request
     * @param Storing $storing
     * @return \App\Models\Allowance|null
     */
    public function confirmRequest(ConfirmAllowanceRequest $request, Storing $storing)
    {
        return $storing->confirmRequest($request->hash);
    }
}
