<?php

namespace App\Http\Controllers;

use App\Interfaces\RevenueSummaryInterface;
use Illuminate\Http\Request;
use App\Jobs\ProcessRevenueCalculation;
use Illuminate\Support\Facades\Cache;

class RevenueController extends Controller
{
    public function __construct(protected RevenueSummaryInterface $revenue)
    {
        
    }

    public function monthlyRevenue()
    {
        $key = 'monthlyRevenue';

        if(Cache::store('redis')->has($key)){
            return Cache::store('redis')->get($key);
        }
        
        ProcessRevenueCalculation::dispatch($key);

        return response()->json(['msg' => 'try again']);
    }

    public function dailyRevenue(){
        return $this->revenue->dailyRevenue();
    }

    public function weeklyRevenue()
    {
        $key = 'weeklyRevenue';

        if(Cache::store('redis')->has($key)){
            return Cache::store('redis')->get($key);
        }
        
        ProcessRevenueCalculation::dispatch($key);

        return response()->json(['msg' => 'try again']);
    }
}
