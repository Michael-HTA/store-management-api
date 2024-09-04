<?php

namespace App\Services;

use App\Interfaces\RevenueSummaryInterface;
use App\Models\InvoiceDetail;
use Carbon\Carbon;

class RevenueSummaryService implements RevenueSummaryInterface{

    /**
     * This will use carbon for daily, weekly and monthly
     * Carbon::now()->endofweek()->format('Y-m-d')
     * Carbon::now()->startofweek()->format('Y-m-d')
     * Carbon::now()->startofmonth()->format('Y-m-d')
     * Carbon::now()->endtofmonth()->format('Y-m-d')
     */
    public function __construct(protected InvoiceDetail $invoiceDetail){}

    public function generateRevenue($start,$end){

        $from = Carbon::now()->$start();
        $to   = Carbon::now()->$end();

        $revenue = $this->invoiceDetail->selectRaw('SUM(sale_price - base_price) as revenue')->whereBetween('created_at',[$from,$to])->value('revenue');

        return $revenue;
    }

    public function dailyRevenue()
    {
        return $this->generateRevenue("startofday","endofday");
    }

    public function monthlyRevenue()
    {
        return $this->generateRevenue("startofmonth","endofmonth");
    }

    public function weeklyRevenue()
    {
        return $this->generateRevenue("startofweek","endofweek");
    }
}
