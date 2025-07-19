<?php
namespace App\Repositories\Purchase;

use App\Models\Purchase;

class PurchaseRepositoryImplementation implements PurchaseRepository{
    public function __construct(protected Purchase $purchase) {}

    public function store(array $data)
    {
        return $this->purchase->create($data);
    }
}