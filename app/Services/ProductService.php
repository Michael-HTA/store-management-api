<?php

namespace App\Services;

use App\Exceptions\InvalidProductException;
use App\Interfaces\ProductInterface;
use App\Models\Product;

class ProductService implements ProductInterface
{

    public function __construct(protected Product $product)
    {
    }

    public function getProductById($id)
    {   //return ModelNotFoundException
        return $this->product::findOrFail($id);
    }

    public function storeProduct(array $data)
    {
        return $this->product->create($data);
    }

    public function getProduct(int $perPage = 30)
    {
        return $this->product->with(['manufacturer', 'supplier', 'modelForm', 'category'])->paginate($perPage);
    }

    public function getOutOfStock(int $stock = 5, int $limit = null)
    {
        $query = $this->product->where('quantity', '<', $stock);

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

        return $product->update($data);

    }

    public function deleteProduct(int $id)
    {
        $product = $this->getProductById($id);

        return $product->delete();

    }

    public function subtractStock(int $id, int $quantity)
    {
        $product = $this->getProductById($id);

        if($product->quantity <= 0) throw new InvalidProductException("Out of Stock!");

        if($product->quantity < $quantity) throw new InvalidProductException('Insufficient stock for this product');

        $product->quantity = $product->quantity - $quantity;

        return $product->save();
    }
}
