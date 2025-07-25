<?php

namespace App\Repositories\Revenue;

use App\Models\InvoiceDetail;
use Illuminate\Support\Facades\DB;

class RevenueRepositoryImplemenation implements RevenueRepository
{
    public function __construct(protected InvoiceDetail $invoiceDetail) {}

    public function generateRevenue($start, $end)
    {
        return $this->invoiceDetail
            ->whereBetween('created_at', [$start, $end])
            ->select(DB::raw('SUM(quantity * (sale_price - base_price)) as revenue'))
            ->value('revenue');
    }
}
