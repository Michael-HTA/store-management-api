<?php
namespace App\Repositories\Stock;

interface StockRepository{
    public function getByProductCode(string $productCode);
    public function update(string $productCode, array $data);
    public function getById(int $id);
    public function getOutOfStock(int $stock = 5, ?int $limit = null);
}