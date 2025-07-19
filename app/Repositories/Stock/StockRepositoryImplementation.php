<?php

namespace App\Repositories\Stock;

use App\Models\Stock;

class StockRepositoryImplementation implements StockRepository
{
    public function __construct(protected Stock $stock) {}

    public function getByProductCode(string $productCode)
    {
        return $this->stock->where('product_code_id', $productCode)->first();
    }

    public function getById(int $id)
    {
        return $this->stock->findOrFail($id);
    }

    public function getOutOfStock(int $stock = 5, ?int $limit = null)
    {
        $query = $this->stock
            ->with([
                'product.manufacturer:id,name',
                'product.supplier:id,name',
                'product.modelForm:id,name',
                'product.category:id,name',
                'product.stock:id,product_code_id,quantity'
            ])
            ->where('quantity', '<=', $stock);

        if ($limit !== null) {
            $query->limit($limit);
        }

        return $query->get()->pluck('product')->filter();
    }

    public function update(Object $stock, array $data)
    {
        return $stock->update($data);
    }

    public function save(Object $stock)
    {
        return $stock->save();
    }

    public function getByProductCodeWithLock(string $productCode)
    {
        return $this->stock->where('product_code_id', $productCode)->lockForUpdate()->first();
    }
}
