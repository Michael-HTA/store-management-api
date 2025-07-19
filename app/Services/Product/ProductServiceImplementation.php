<?php

namespace App\Services\Product;

use App\Services\Product\ProductService;
use App\Repositories\Product\ProductRepository;
use App\Services\Cache\CacheInterface;
use Illuminate\Support\Facades\DB;

class ProductServiceImplementation implements ProductService
{
    public function __construct(protected ProductRepository $productRepository, protected CacheInterface $cache) {}

    public function store(array $data)
    {
        return $this->productRepository->store($data);
    }

    public function getAll()
    {
        return $this->productRepository->getAll();
    }

    public function paginate(int $perPage, int $requestPage)
    {
        $key = "products_paginate_{$requestPage}";

        return $this->cache->remember($key, 600, function () use ($perPage) {
            return $this->productRepository->paginate($perPage);
        });
    }

    public function getByProductCode(string $productCode)
    {
        $key = "product_code_{$productCode}";

        return $this->cache->remember($key, 600, function () use ($productCode) {
            return $this->productRepository->getByProductCode($productCode);
        });
    }

    public function getById(int $id)
    {
        $key = "product_{$id}";

        return $this->cache->remember($key, 600, function () use ($id) {
            return $this->productRepository->getById($id);
        });
    }

    public function updateByProductCode(string $productCode, array $data)
    {   
        $product = $this->productRepository->getByProductCode($productCode);

        return $this->productRepository->update($product, $data);
    }

    public function updateById(int $id, array $data)
    {
        $product = $this->productRepository->getById($id);

        return $this->productRepository->update($product, $data);
    }

    public function updateByProductCodeWithTransaction(string $productCode, array $data)
    {
        return DB::transaction(function () use ($productCode, $data) 
        {
            $product = $this->productRepository->getByProductCodeWithLock($productCode);

            return $this->productRepository->update($product, $data);
        });
    }

    public function updateByIdWithTransaction(int $id, array $data)
    {
        return DB::transaction(function () use ($id, $data) 
        {
            $product = $this->productRepository->getByIdWithLock($id);

            return $this->productRepository->update($product, $data);
        });
    }

    public function deleteByProductCode(string $productCode)
    {
        $product = $this->productRepository->getByProductCode($productCode);

        return $this->productRepository->delete($product);
    }

    public function deleteById(int $id)
    {
        return $this->productRepository->deleteById($id);
    }

    public function updateBasePrice(string $productCode, float $basePrice)
    {
        $product = $this->productRepository->getByProductCodeWithLock($productCode);

        if ($product->base_price < $basePrice) {
            $product->base_price = $basePrice;
        }

        return $this->productRepository->save($product);
    }
}
