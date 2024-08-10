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
        $dailyRevenue = 0;
        $from = Carbon::now()->$start()->format('Y-m-d');
        $to   = Carbon::now()->$end()->format('Y-m-d');
        $invoices = $this->invoiceDetail->whereBetween('created_at',[$from,$to])->get();
        foreach($invoices as $invoice){
            $dailyRevenue += $invoice['quantity'] * ($invoice['sale_price'] - $invoice['base_price']);
        }

        return $dailyRevenue;
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
