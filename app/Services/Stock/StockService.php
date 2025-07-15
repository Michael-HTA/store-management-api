<?php
namespace App\Services\Stock;

interface StockService{
    public function getOutOfStock(int $stock, int $limit);
    public function subtract(string $id, int $quantity);
    public function add(int $stock, string $id);
}
