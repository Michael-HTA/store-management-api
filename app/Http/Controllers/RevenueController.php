<?php

namespace App\Http\Controllers;

use App\Interfaces\RevenueSummaryInterface;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    public function __construct(protected RevenueSummaryInterface $revenue)
    {
        
    }

    public function monthlyRevenue(){
        return $this->revenue->monthlyRevenue();
    }

    public function dailyRevenue(){
        return $this->revenue->dailyRevenue();
    }

    public function weeklyRevenue(){
        return $this->revenue->weeklyRevenue();
    }
}
