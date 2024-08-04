<?php
namespace App\Services;

use App\Http\Requests\ProductStoreRequest;
use App\Interfaces\ProductInterface;
use App\Models\Product;

class ProudctService implements ProductInterface{

    public function __construct(protected Product $product)
    {

    }

    public function storeProduct(array $data)
    {

    }

    public function getProduct(){

    }

    public function getOutOfStock(int $stock = 5, int $limit = null)
    {
        if($stock < 0) return false;

        $query = $this->product::where('stock','<',$stock);

        if(is_null($limit)) return $query->get();

        return $query->limit($limit)->get();
    }

    public function findProduct(int $id)
    {

    }

    public function updateProduct(int $id, array $data)
    {

    }

    public function deleteProduct(int $id)
    {

    }
}
