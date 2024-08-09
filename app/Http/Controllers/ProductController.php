<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Interfaces\ProductInterface;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    public function store(ProductStoreRequest $request)
    {
        try {

            $result = $this->product->storeProduct($request->validated());

            return response()->success($request, new ProductResource($result), 'Store successful', 200);

        } catch (Exception $e) {

            // Log::error($e->getMessage());

            return response()->error($request, null, 'Internal Server Error', 500);
        }
        
    }

    public function update($id, ProductStoreRequest $request){
        try
        {
            $data = $request->validated();

            $result = new ProductResource($this->product->updateProduct($id,$data));

            return response()->success($request, $result, 'Update successful', 200);
            
        }catch (Exception $e) {

            // Log::error($e->getMessage());

            return response()->error($request, null, 'Internal Server Error', 500);
        }
    }

    public function delete($id, Request $request){
        try
        {
            $this->product->deleteProduct($id);

            return response()->success($request, null, 'Delete successful', 200);

        }catch (Exception $e) {

            // Log::error($e->getMessage());

            return response()->error($request, null, 'Internal Server Error', 500);
        }
    }

}
