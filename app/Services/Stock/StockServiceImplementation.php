<?php
namespace App\Services\Stock;

use App\Exceptions\InvalidProductException;
use App\Repositories\Stock\StockRepository;
use App\Services\Stock\StockService;

class  StockServiceImplementation implements StockService{

    public function __construct(protected StockRepository $stockRepository){}

    public function subtract(string $productCode, int $quantity)
    {
        $stock = $this->stockRepository->getByProductCode($productCode);

        if($stock->quantity <= 0) throw new InvalidProductException("Out of Stock!");

        if($stock->quantity < $quantity) throw new InvalidProductException('Insufficient stock for this product');

        $stock->quantity = $stock->quantity - $quantity;

        return $stock->save();
    }

    public function getOutOfStock(int $stock = 5, ?int $limit = null)
    {
        return $this->stockRepository->getOutOfStock($stock, $limit);
    }

    public function add(int $stock, string $productCode)
    {
        $product = $this->stockRepository->getByProductCode($productCode);

        $product->quantity += $stock;

        return $product->save();
    }
}
