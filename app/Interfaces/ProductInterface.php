<?php
namespace App\Interfaces;

use App\Http\Requests\ProductStoreRequest;

interface ProductInterface{

    public function storeProduct(array $data);
    public function getProduct(int $perPage);
    public function findProduct(int $id);
    public function updateProduct(int $id, array $data);
    public function deleteProduct(int $id);
    public function getOutOfStock(int $stock, int $limit);

}
