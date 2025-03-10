<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseStoreRequest;
use App\Http\Resources\PurchaseResource;
use App\Interfaces\PurchaseInterface;
use App\Interfaces\StockManagementInterface;
use Exception;

class PurchaseController extends Controller
{
    public function processPurchase(PurchaseStoreRequest $request, PurchaseInterface $purchase, StockManagementInterface $stock)
    {
        try {
            $data = $request->validated();

            $result = $purchase->processPurchase($data);

            if($result){
                $stock->addStock($result->quantity,$result->product_code_id);
            }

            return response()->success($request, new PurchaseResource($result), 'Record insertion successful', 200);
        } catch (Exception $e) {

            return response()->error($request, null, $e->getMessage(), 500);
        }
    }
}
