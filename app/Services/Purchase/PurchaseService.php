<?php
namespace App\Services\Purchase;

interface PurchaseService{
    public function makePurchase(array $data);
}