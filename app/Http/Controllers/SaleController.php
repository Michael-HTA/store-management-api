<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidProductException;
use App\Http\Requests\SaleRequest;
use App\Http\Resources\InvoiceDetailCollection;
use App\Interfaces\SaleInterface;
use Exception;

class SaleController extends Controller
{
    public function __construct(protected SaleInterface $saleService) {}

    public function processSale(SaleRequest $request)
    {   

        
        try {
            $data = $request->validated();

            $result = $this->saleService->processSale($data['data']);
   
            return new InvoiceDetailCollection($result,200,"Sale successful");

        } catch (Exception $e) {
            
            // Log::error($e->getMessage());

            return response()->error($request, null, $e->getMessage(), 500);

        } catch(InvalidProductException $e)
        {
             return response()->error($request, null, $e->getMessage(), 500);
        }
    }
}
