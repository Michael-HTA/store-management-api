<?php
namespace App\Repositories\Product;

interface ProductRepository{

    public function getAll();
    public function store(array $data);
    public function getByProductCode(string $productCode);
    public function getById(int $id);
    public function paginate(int $perPage);
    public function update($product, array $data);
    public function save($product);
    public function delete($product);
    public function deleteById(int $id);
    public function getByProductCodeWithLock(string $productCode);
    public function getByIdWithLock(int $id);
}
