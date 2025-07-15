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

    public function getByCode(string $productCode)
    {
        return $this->productRepository->getByCode($productCode);
    }

    public function getById(int $id)
    {
        return $this->productRepository->getById($id);
    }

    public function updateByCode(string $productCode, array $data)
    {
        return $this->productRepository->updateByCode($productCode, $data);
    }

    public function updateById(int $id, array $data)
    {
        return $this->productRepository->updateById($id, $data);
    }

    public function deleteByCode(string $productCode)
    {
        return $this->productRepository->deleteByCode($productCode);
    }

    public function deleteById(int $id)
    {
        return $this->productRepository->deleteById($id);
    }
}
