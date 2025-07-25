<?php
namespace App\Services\Purchase;

use App\Repositories\Purchase\PurchaseRepository;
use App\Services\Stock\StockService;
use App\Services\Product\ProductService;
use Illuminate\Support\Facades\DB;

class PurchaseServiceImplementation implements PurchaseService{

    public function __construct(protected PurchaseRepository $purchaseRepository, protected StockService $stockService, protected ProductService $productService) {}

    public function makePurchase(array $data)
    {  
        return DB::transaction(function () use ($data) {

            $this->productService->updateBasePrice($data['product_code_id'], $data['purchase_price']);

            $this->stockService->add($data['quantity'], $data['product_code_id']);

            return $this->purchaseRepository->store($data);
        });
    }
}