<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use App\Services\Stock\StockService;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function __construct(protected StockService $stock)
    {
        
    }
    public function outOfStock(Request $request)
    {
        $stock = $request->query('stock', 5);

        $limit = $request->query('limit', 10);
        
        return new ProductCollection($this->stock->getOutOfStock($stock,$limit));
    }
}
