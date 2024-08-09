<?php

namespace App\Services;

use App\Interfaces\SaleInterface;
use App\Interfaces\StockManagementInterface;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use Illuminate\Support\Facades\DB;

class SaleService implements SaleInterface
{

    public function __construct(
        protected Invoice $invoice,
        protected InvoiceDetail $invoiceDetail,
        protected StockManagementInterface $stock
    ) {}

    public function processSale(array $items)
    {

        $result = collect();

        /**
         *if fail exception will throw
         *need to reconfigure after changing the database for product_code
         */

        DB::transaction(function () use ($items, $result) {

            $invoiceNumber = $this->invoice->generateInvoice();
 
            foreach ($items as $item) {
         
                $item['invoice_number_id'] = $invoiceNumber;
                
                $this->stock->subtractStock($item['product_code_id'], $item['quantity']);


                $data = $this->invoiceDetail->create($item);

                $result->push($data);
            }
        });

        return $result;
    }
}
