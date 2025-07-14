<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseStoreRequest;
use App\Http\Resources\PurchaseResource;
use App\Interfaces\PurchaseInterface;
use App\Interfaces\StockManagementInterface;
use App\Interfaces\ProductInterface;
use Exception;

class PurchaseController extends Controller
{
    public function store(PurchaseStoreRequest $request, PurchaseInterface $purchase, StockManagementInterface $stock, ProductInterface $product)
    {
        try {
            $data = $request->validated();

            $result = $purchase->store($data);

            $retrievedProduct = $product->getProductByProductCode($result->product_code_id);

            if ($result && $retrievedProduct->base_price < $result->purchase_price) {
                $product->updateProduct($result->product_code_id, ['base_price' => $result->purchase_price]);
            }

            if ($result) {
                $stock->addStock($result->quantity, $result->product_code_id);
            }

            return response()->success($request, new PurchaseResource($result), 'Record insertion successful', 200);
        } catch (Exception $e) {

            return response()->error($request, null, $e->getMessage(), 500);
        }
    }
}
