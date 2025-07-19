<?php

namespace App\Services\Product;

use App\Services\Product\ProductService;
use App\Repositories\Product\ProductRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;

class ProductServiceImplementation implements ProductService
{
    public function __construct(protected ProductRepository $productRepository) {}

    public function store(array $data)
    {
        return $this->productRepository->store($data);
    }

    public function getAll()
    {
        return $this->productRepository->getAll();
    }

    public function paginate(int $perPage)
    {
        $page = Request::get('page', 1);

        $key = "products_paginate_{$page}";
        
        return Cache::store('redis')->remember($key, 600, function () use ($perPage) {
            return $this->productRepository->paginate($perPage);
        });
    }

    public function getByProductCode(string $productCode)
    {
        $key = "product_code_{$productCode}";

        return Cache::store('redis')->remember($key, 600, function () use ($productCode) {
            return $this->productRepository->getByCode($productCode);
        });

    }

    public function getById(int $id)
    {
        $key = "product_{$id}";

        return Cache::store('redis')->remember($key, 600, function () use ($id) {
            return $this->productRepository->getById($id);
        });
    }

    public function updateByProductCode(string $productCode, array $data)
    {
        $product = $this->productRepository->getByCode($productCode);

        return $this->productRepository->update($product, $data);
    }

    public function updateById(int $id, array $data)
    {
        $product = $this->productRepository->getById($id);

        return $this->productRepository->update($product, $data);
    }

    public function deleteByProductCode(string $productCode)
    {
        $product = $this->productRepository->getByCode($productCode);

        return $this->productRepository->delete($product);
    }

    public function deleteById(int $id)
    {
        return $this->productRepository->deleteById($id);
    }
}
