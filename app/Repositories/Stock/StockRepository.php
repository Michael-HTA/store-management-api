<?php
namespace App\Repositories\Stock;

interface StockRepository{
    public function getByProductCode(string $productCode);
    public function getById(int $id);
    public function getOutOfStock(int $stock = 5, ?int $limit = null);
    public function update(Object $stock, array $data);
    public function save(Object $stock);
    public function getByProductCodeWithLock(string $productCode);
}