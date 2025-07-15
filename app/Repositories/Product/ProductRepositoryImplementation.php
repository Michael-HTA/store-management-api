<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\Product\ProductRepository;

class ProductRepositoryImplementation implements ProductRepository
{
    public function __construct(protected Product $product) {}

    public function getAll()
    {
        return $this->product
            ->with(['manufacturer:id,name', 'supplier:id,name', 'modelForm:id,name', 'category:id,name'])
            ->get();
    }

    public function store(array $data)
    {
        return $this->product->create($data);
    }

    public function getByCode(string $productCode)
    {
        return $this->product
            ->with(['manufacturer:id,name', 'supplier:id,name', 'modelForm:id,name', 'category:id,name', 'stock:id,product_id,quantity'])
            ->where('product_code', $productCode)
            ->firstOrFail();
    }

    public function getById(int $id)
    {
        return $this->product
            ->with(['manufacturer:id,name', 'supplier:id,name', 'modelForm:id,name', 'category:id,name', 'stock:id,product_id,quantity'])
            ->findOrFail($id);
    }

    public function paginate(int $perPage)
    {
        return $this->product
            ->with(['manufacturer:id,name', 'supplier:id,name', 'modelForm:id,name', 'category:id,name', 'stock:id,product_id,quantity'])
            ->paginate($perPage);
    }

    public function updateByCode(string $productCode, array $data)
    {
        return $this->product
            ->where('product_code', $productCode)
            ->update($data);
    }

    public function updateById(int $id, array $data)
    {
        return $this->product
            ->where('id', $id)
            ->update($data);
    }

    public function deleteByCode(string $productCode)
    {
        return $this->product
            ->where('product_code', $productCode)
            ->delete();
    }

    public function deleteById(int $id)
    {
        return $this->product->destroy($id);
    }
}
