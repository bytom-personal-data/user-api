<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DataAdd as DataAddRequest;
use App\Services\Data\Storing;

class DataController extends Controller
{
    public function add(DataAddRequest $request, Storing $storing)
    {
        return $storing->add($request->label, $request->data, $request->owner_hash);
    }
}
