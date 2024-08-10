<?php

namespace App\Interfaces;

interface RevenueSummaryInterface
{   
    public function generateRevenue($start,$end);
    public function dailyRevenue();
    public function monthlyRevenue();
    public function weeklyRevenue();
}
