<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Services\Product\ProductService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    //

    public function __construct(protected ProductService $product){}

    public function index()
    {
        return new ProductCollection($this->product->paginate(20));
    }

    public function show($id, Request $request)
    {
        try
        {   
            $data = new ProductResource($this->product->getById($id));

            return Response::success(request: $request, data: $data);

        }catch(ModelNotFoundException $e)
        {
            return Response::error($request,null,'Do not found the item', 404);
        }
    }

    public function store(ProductStoreRequest $request)
    {
        try {

            $result = $this->product->store($request->validated());

            return Response::success($request, new ProductResource($result), 'Store successful', 200);

        } catch (Exception $e) {

            // Log::error($e->getMessage());

            return Response::error($request, null, 'Internal Server Error', 500);
        }

    }

    public function update($id, ProductStoreRequest $request){
        try
        {
            $data = $request->validated();

            $result = new ProductResource($this->product->updateById($id,$data));

            return Response::success($request, $result, 'Update successful', 200);

        }catch (Exception $e) {

            // Log::error($e->getMessage());

            return Response::error($request, null, 'Internal Server Error', 500);
        }
    }

    public function delete($id, Request $request){
        try
        {
            $this->product->deleteById($id);

            return Response::success($request, null, 'Delete successful', 200);

        }catch (Exception $e) {

            // Log::error($e->getMessage());

            return Response::error($request, null, 'Internal Server Error', 500);
        }
    }

}
