<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseStoreRequest;
use App\Http\Resources\PurchaseResource;
use App\Interfaces\PurchaseInterface;
use App\Services\Product\ProductService;
use Exception;
use Illuminate\Support\Facades\Response;

use App\Services\Stock\StockService;

class PurchaseController extends Controller
{
    public function store(PurchaseStoreRequest $request, PurchaseInterface $purchase, StockService $stock, ProductService $product)
    {
        try {
            $data = $request->validated();

            $result = $purchase->store($data);

            $retrievedProduct = $product->getByProductCode($result->product_code_id);

            if ($result && $retrievedProduct->base_price < $result->purchase_price) {
                $product->updateByProductCode($result->product_code_id, ['base_price' => $result->purchase_price]);
            }

            if ($result) {
                $stock->add($result->quantity, $result->product_code);
            }

            return Response::success($request, new PurchaseResource($result), 'Record insertion successful', 200);
        } catch (Exception $e) {

            return Response::error($request, null, $e->getMessage(), 500);
        }
    }
}
