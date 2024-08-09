<?php

namespace App\Services;

use App\Models\InvoiceDetail;

class RevenueService{
    
    /**
     * This will use carbon for daily, weekly and monthly
     * Carbon::now()->endofweek()->format('Y-m-d')
     * Carbon::now()->startofweek()->format('Y-m-d')
     * Carbon::now()->startofmonth()->format('Y-m-d')
     * Carbon::now()->endtofmonth()->format('Y-m-d')
     */
    public function dailyRevenue(){}
    public function monthlyRevenue(){}
    public function weeklyRevenue(){}
}
