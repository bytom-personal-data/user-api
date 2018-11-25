<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Constants\Labels;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConfirmAllowanceRequest;
use App\Http\Requests\DataAdd as DataAddRequest;
use App\Http\Requests\DataGet as DataGetRequest;
use App\Http\Requests\VerifyData as VerifyDataRequest;
use App\Http\Resources\Data as DataResource;
use App\Models\Data;
use App\Services\Data\Storing;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function createRequestsByLabel(DataGetRequest $request, Storing $storing)
    {
        return $storing->makeDataRequest($request->labels, $request->owner_hash);
    }

    public function getAllRequests(Request $request, Storing $storing)
    {
        if ($status = $request->get('status')) {
            return $storing->getAllRequests($status);
        } else {
            return $storing->getAllRequests();
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
     * @return array
     * @throws \Exception
     */
    public function confirmRequest(ConfirmAllowanceRequest $request, Storing $storing)
    {
        return [
            'status' => 'confirmed',
            'allowance' => $storing->confirmRequest($request->hash)
        ];
    }

    public function verify(VerifyDataRequest $request, Storing $storing)
    {
        $data = Data::where('hash', $request->hash)->first();

        if(!$data) {
            throw new NotFoundHttpException("Data with this hash not exists.");
        }

        return $storing->verify($data);
    }
}
