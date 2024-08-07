<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Interfaces\ProductInterface;
use App\Services\ProductService;
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

    

}
