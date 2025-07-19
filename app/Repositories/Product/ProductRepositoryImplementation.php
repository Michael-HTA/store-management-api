<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\Product\ProductRepository;

class ProductRepositoryImplementation implements ProductRepository
{
    protected $with = [
        'manufacturer:id,name',
        'supplier:id,name',
        'modelForm:id,name',
        'category:id,name',
        'stock:id,product_code_id,quantity',
    ];

    public function __construct(protected Product $product) {}

    public function getAll()
    {
        return $this->product->with($this->with)->get();
    }

    public function store(array $data)
    {
        return $this->product->create($data);
    }

    public function getByProductCode(string $productCode)
    {
        return $this->product->with($this->with)->where('product_code', $productCode)->firstOrFail();
    }

    public function getById(int $id)
    {
        return $this->product->with($this->with)->findOrFail($id);
    }

    public function paginate(int $perPage)
    {
        return $this->product->with($this->with)->paginate($perPage);
    }

    public function save($product)
    {
        return $product->save();
    }

    public function update($product, array $data)
    {
        return $product->update($data);
    }

    public function delete($product)
    {
        return $product->delete();
    }

    public function deleteById(int $id)
    {
        return $this->product->destroy($id);
    }

    public function getByProductCodeWithLock(string $productCode)
    {   
        return $this->product->where('product_code', $productCode)->lockForUpdate()->first();
    }

    public function getByIdWithLock(int $id)
    {
        return $this->product->where('id', $id)->lockForUpdate()->first();
    }
}
