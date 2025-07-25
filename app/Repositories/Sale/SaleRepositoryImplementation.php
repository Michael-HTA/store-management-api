<?php
namespace App\Repositories\Sale;

use App\Models\InvoiceDetail;
use App\Repositories\Sale\SaleRepository;

class SaleRepositoryImplementation implements SaleRepository{

    public function __construct(protected InvoiceDetail $invoiceDetail){}
    
    public function create(array $data){
        return $this->invoiceDetail->create($data);
    }
}