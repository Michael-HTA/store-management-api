<?php
namespace App\Repositories\Purchase;

interface PurchaseRepository{
    public function store(array $data);
}