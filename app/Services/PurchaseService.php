<?php
namespace App\Services;

use App\Interfaces\PurchaseInterface;
use App\Models\Purchase;

class PurchaseService implements PurchaseInterface{

    
    public function store($data)
    {
        return Purchase::create($data);
    }
}