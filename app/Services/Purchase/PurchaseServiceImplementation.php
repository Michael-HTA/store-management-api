<?php
namespace App\Services\Purchase;

use App\Repositories\Product\ProductRepository;
use App\Repositories\Purchase\PurchaseRepository;
use App\Services\Stock\StockService;
use App\Services\Product\ProductService;
use Illuminate\Support\Facades\DB;
use Exception;

class PurchaseServiceImplementation implements PurchaseService{

    public function __construct(protected PurchaseRepository $purchaseRepository, protected StockService $stockService, protected ProductRepository $productRepository) {}

    public function makePurchase(array $data)
    {  
        $product = $this->productRepository->getByCode($data['product_code_id']);

        if($product->base_price < $data['purchase_price'])
        {
            $product->base_price = $data['purchase_price'];
        }

        return DB::transaction(function () use ($data, $product) {

            $this->productRepository->update($product, ['base_price' => $data['purchase_price']]);

            $this->stockService->add($data['quantity'], $data['product_code_id']);

            return $this->purchaseRepository->store($data);
        });
    }
}