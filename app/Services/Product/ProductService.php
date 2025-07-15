<?php
namespace App\Services\Product;

interface ProductService{

    public function store(array $data);
    public function getAll();
    public function paginate(int $perPage);
    public function getByProductCode(string $productCode);
    public function getById(int $id);
    public function updateByProductCode(string $productCode, array $data);
    public function updateById(int $id, array $data);
    public function deleteByProductCode(string $productCode);
    public function deleteById(int $id);
}
