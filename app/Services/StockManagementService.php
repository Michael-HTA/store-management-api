<?php
namespace App\Services;

use App\Exceptions\InvalidProductException;
use App\Interfaces\StockManagementInterface;
use App\Models\Product;

class StockManagementService implements StockManagementInterface{

    public function __construct(protected ProductService $productService, protected Product $product){}

    public function subtractStock(string $id, int $quantity)
    {
        $product = $this->productService->getProductByProductCode($id);

        if($product->quantity <= 0) throw new InvalidProductException("Out of Stock!");

        if($product->quantity < $quantity) throw new InvalidProductException('Insufficient stock for this product');

        $product->quantity = $product->quantity - $quantity;

        return $product->save();
    }

    public function getOutOfStock(int $stock = 5, int $limit = null)
    {
        $query = $this->product->where('quantity', '<', $stock);

        if ($limit !== null) $query->limit($limit);

        return $query->get();
    }
}