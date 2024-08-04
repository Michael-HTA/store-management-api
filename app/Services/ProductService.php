<?php

namespace App\Services;

use App\Interfaces\ProductInterface;
use App\Models\Product;

class ProductService implements ProductInterface
{

    public function __construct(protected Product $product)
    {
    }

    protected function getProductById($id){

        return $this->product->where('id',$id)->first();

    }

    public function storeProduct(array $data)
    {   
        return $this->product->create($data);

    }

    public function getProduct(int $perPage)
    {
        return $this->product->with(['manufacturer', 'supplier', 'modelForm', 'category'])->paginate($perPage);
    }

    public function getOutOfStock(int $stock = 5, int $limit = null)
    {
        $query = $this->product->where('stock', '<', $stock);

        if ($limit !== null) $query->limit($limit);

        return $query->get();
    }

    public function findProduct(int $id)
    {
        return $this->product->with(['manufacturer', 'supplier', 'modelForm', 'category'])->where('id', $id)->first();
    }

    public function updateProduct(int $id, array $data)
    {
        $product = $this->getProductById($id);

        return $product ? $product->update($data) : null;

    }

    public function deleteProduct(int $id)
    {
        $product = $this->getProductById($id);

        return $product ? false : $product->delete();

    }
}
