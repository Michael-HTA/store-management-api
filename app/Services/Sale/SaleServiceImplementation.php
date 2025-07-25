<?php
namespace App\Services\Sale;

use App\Models\Invoice;
use App\Repositories\Sale\SaleRepository;
use App\Services\Sale\SaleService;
use App\Services\Stock\StockService;
use Illuminate\Support\Facades\DB;

class SaleServiceImplementation implements SaleService{
    public function __construct(protected SaleRepository $saleRepository, protected StockService $stockService, protected Invoice $invoice)
    {
        
    }

    public function processSale(array $items)
    {
        $collection = collect();
        
        DB::transaction(function() use ($items, $collection){
            
            $invoiceNumber = $this->invoice->generateInvoice();

            foreach ($items as $item) {
         
                $item['invoice_number_id'] = $invoiceNumber;
                
                // this one gonna use stock service
                $this->stockService->subtract($item['product_code_id'], $item['quantity']);

                // this one gonna use invocedetail repository
                $data = $this->saleRepository->create($item);

                $collection->push($data);
            }
        });

        return $collection;
    }
}