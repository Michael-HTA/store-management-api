<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Interfaces\ProductInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function __construct(protected ProductInterface $product)
    {
        
    }

    public function index()
    {
        return new ProductCollection($this->product->getProduct(30));
    }

    public function show($id, Request $request)
    {
        try
        {   
            $data = new ProductResource($this->product->findProduct($id));

            return response()->success($request, $data);

        }catch(ModelNotFoundException $e)
        {
            return response()->error($request,null,'Do not found the item', 404);
        }
    }

    public function outOfStock(Request $request)
    {
        return new ProductCollection($this->product->getOutOfStock());

    }

    
    

}
