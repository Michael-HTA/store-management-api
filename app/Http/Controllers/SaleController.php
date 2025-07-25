<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidProductException;
use App\Http\Requests\SaleRequest;
use App\Http\Resources\InvoiceDetailCollection;
use App\Services\Sale\SaleService;
use Exception;
use Illuminate\Support\Facades\Response;

class SaleController extends Controller
{
    public function __construct(protected SaleService $saleService) {}

    public function processSale(SaleRequest $request)
    {   

        
        try {
            $data = $request->validated();

            $result = $this->saleService->processSale($data['data']);
   
            return new InvoiceDetailCollection($result,200,"Sale successful");

        } catch (Exception $e) {
            
            // Log::error($e->getMessage());

            return Response::error($request, null, $e->getMessage(), 500);

        } catch(InvalidProductException $e)
        {
             return Response::error($request, null, $e->getMessage(), 500);
        }
    }
}
