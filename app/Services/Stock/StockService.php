<?php
namespace App\Services\Stock;

interface StockService{
    public function getOutOfStock(int $stock, int $limit);
    public function subtract(string $id, int $quantity);
    public function addWithTransaction(int $quantity, string $id);
    public function add(int $quantity, string $id);
}
