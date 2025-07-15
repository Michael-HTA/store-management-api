<?php
namespace App\Services\Product;

interface ProductService{

    public function store(array $data);
    public function getAll();
    public function paginate(int $perPage);
    public function getByCode(string $productCode);
    public function getById(int $id);
    public function updateByCode(string $id, array $data);
    public function updateById(int $id, array $data);
    public function deleteByCode(string $productCode);
    public function deleteById(int $id);
}
