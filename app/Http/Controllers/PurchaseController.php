<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseStoreRequest;
use App\Http\Resources\PurchaseResource;
use App\Services\Purchase\PurchaseService;
use Exception;
use Illuminate\Support\Facades\Response;

class PurchaseController extends Controller
{
    public function store(PurchaseStoreRequest $request, PurchaseService $purchase)
    {
        try {
            $data = $request->validated();

            $result = $purchase->makePurchase($data);

            return Response::success($request, new PurchaseResource($result), 'Record insertion successful', 200);
            
        } catch (Exception $e) {

            return Response::error($request, null, $e->getMessage(), 500);
        }
    }
}
