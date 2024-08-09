<?php
namespace App\Interfaces;

use App\Http\Requests\ProductStoreRequest;

interface ProductInterface{

    public function storeProduct(array $data);
    public function getProductByProductCode(string $id);
    public function getProduct(int $perPage);
    public function findProduct(string $id);
    public function updateProduct(string $id, array $data);
    public function deleteProduct(string $id);
}
