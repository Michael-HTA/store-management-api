<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessRevenueCalculation;
use App\Services\Revenue\RevenueService;
use Illuminate\Support\Facades\Cache;

class RevenueController extends Controller
{
    public function __construct(protected RevenueService $revenue)
    {
        
    }

    public function monthlyRevenue()
    {
       $result = $this->revenue->monthlyRevenue();

       return response()->json(['monthlyRevenue' => $result]);
    }

    public function dailyRevenue(){
        $result = $this->revenue->dailyRevenue();
        return response()->json(['dailyRevenue' => $result]);
    }

    public function weeklyRevenue()
    {
        $result = $this->revenue->weeklyRevenue();
        return response()->json(['weeklyRevenue' => $result]);
    }
}
