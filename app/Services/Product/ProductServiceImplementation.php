<?php

namespace App\Services\Product;

use App\Services\Product\ProductService;
use App\Repositories\Product\ProductRepository;

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
        return $this->productRepository->paginate($perPage);
    }

    public function getByProductCode(string $productCode)
    {
        return $this->productRepository->getByCode($productCode);
    }

    public function getById(int $id)
    {
        return $this->productRepository->getById($id);
    }

    public function updateByProductCode(string $productCode, array $data)
    {
        $product = $this->productRepository->getByCode($productCode);

        if (!$product) {
            throw new \Exception('Product not found');
        }

        return $this->productRepository->update($product, $data);
    }

    public function updateById(int $id, array $data)
    {
        $product = $this->productRepository->getById($id);

        if (!$product) {
            throw new \Exception('Product not found');
        }

        return $this->productRepository->update($product, $data);
    }

    public function deleteByProductCode(string $productCode)
    {
        $product = $this->productRepository->getByCode($productCode);

        if (!$product) {
            throw new \Exception('Product not found');
        }

        return $this->productRepository->delete($product);
    }

    public function deleteById(int $id)
    {
        return $this->productRepository->deleteById($id);
    }
}
