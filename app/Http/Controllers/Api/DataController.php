<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Constants\Labels;
use App\Http\Controllers\Controller;
use App\Http\Requests\DataAdd as DataAddRequest;
use App\Http\Requests\DataGet as DataGetRequest;
use App\Services\Data\Storing;

class DataController extends Controller
{
    public function add(DataAddRequest $request, Storing $storing)
    {
        return $storing->add($request->label, $request->data, $request->owner_hash);
    }

    public function labels()
    {
        return Labels::getLabels();
    }

    public function requestByLabel(DataGetRequest $request, Storing $storing)
    {
        return $storing->makeDataRequest($request->labels, $request->owner_hash);
    }

    public function getByLabel(DataGetRequest $request, Storing $storing)
    {
        return $storing->getData($request->labels, $request->owner_hash);
    }
}
