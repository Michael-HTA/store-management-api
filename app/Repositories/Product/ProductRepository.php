<?php
namespace App\Repositories\Product;

interface ProductRepository{

    public function getAll();
    public function store(array $data);
    public function getByCode(string $productCode);
    public function getById(int $id);
    public function paginate(int $perPage);
    public function updateByCode(string $productCode, array $data);
    public function updateById(int $id, array $data);
    public function deleteBycode(string $productCode);
    public function deleteById(int $id);
}
