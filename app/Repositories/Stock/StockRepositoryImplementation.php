<?php

namespace App\Repositories\Stock;

use App\Models\Stock;

class StockRepositoryImplementation implements StockRepository
{
    public function __construct(protected Stock $stock) {}

    public function getByProductCode(string $productCode)
    {
        return $this->stock->where('product_code', $productCode)->first();
    }

    public function update(string $productCode, array $data)
    {
        return $this->stock->where('product_code', $productCode)->update($data);
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
                'product.stock:id,product_id,quantity'
            ])
            ->where('quantity', '<=', $stock);

        if ($limit !== null) {
            $query->limit($limit);
        }

        return $query->get()->pluck('product')->filter();
    }
}
