<?php

namespace App\Services\Stock;

use App\Exceptions\InvalidProductException;
use App\Repositories\Stock\StockRepository;
use App\Services\Stock\StockService;
use Illuminate\Support\Facades\DB;

class  StockServiceImplementation implements StockService
{

    public function __construct(protected StockRepository $stockRepository) {}

    public function subtract(string $productCode, int $quantity)
    {
        $stock = $this->stockRepository->getByProductCodeWithLock($productCode);

        if ($stock->quantity <= 0) {
            throw new InvalidProductException("Out of Stock!");
        }

        if ($stock->quantity < $quantity) {
            throw new InvalidProductException("Insufficient stock for this product");
        }

        $stock->quantity -= $quantity;

        return $this->stockRepository->save($stock);
    }

    public function subtractWithTransaction(string $productCode, int $quantity)
    {
        return DB::transaction(function () use ($productCode, $quantity) {
            return $this->subtract($productCode, $quantity);
        });
    }


    public function getOutOfStock(int $stock = 5, ?int $limit = null)
    {
        return $this->stockRepository->getOutOfStock($stock, $limit);
    }

    public function addWithTransaction(int $quantity, string $productCode)
    {
        return DB::transaction(function () use ($quantity, $productCode) {

            return $this->add($quantity, $productCode);
        });
    }

    public function add(int $quantity, string $productCode)
    {
        $stock = $this->stockRepository->getByProductCodeWithLock($productCode);

        $stock->quantity += $quantity;

        return $this->stockRepository->save($stock);
    }
}
