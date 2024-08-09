<?php

namespace App\Services;

use App\Exceptions\InvalidProductException;
use App\Interfaces\ProductInterface;
use App\Models\Product;

class ProductService implements ProductInterface
{

    public function __construct(protected Product $product)
    {
    }

    public function getProductByProductCode(string $id)
    {   
        //return ModelNotFoundException if fail
        return $this->product::where('product_code',$id)->firstOrFail();
    }

    public function storeProduct(array $data)
    {   
        $prduct_code = $this->product->generateProudctCode();

        $data['product_code'] = $prduct_code;

        return $this->product->create($data);
    }

    public function getProduct(int $perPage = 30)
    {
        return $this->product->with(['manufacturer:id,name', 'supplier:id,name', 'modelForm:id,name', 'category:id,name'])->paginate($perPage);
    }

    public function findProduct(string $id)
    {
        return $this->product->with(['manufacturer:id,name', 'supplier:id,name', 'modelForm:id,name', 'category:id,name'])->where('product_code', $id)->firstOrFail();
    }

    public function updateProduct(string $id, array $data)
    {
        $product = $this->getProductByProductCode($id);

        return $product->update($data);

    }

    public function deleteProduct(string $id)
    {
        $product = $this->getProductByProductCode($id);

        return $product->delete();

    }

}
