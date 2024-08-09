<?php

namespace App\Interfaces;

interface StockManagementInterface
{
    public function getOutOfStock(int $stock, int $limit);
    public function subtractStock(string $id, int $quantity);
}
