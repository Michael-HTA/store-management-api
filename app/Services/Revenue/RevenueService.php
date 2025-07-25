<?php
namespace App\Services\Revenue;

interface RevenueService{
    public function generateRevenue($start,$end);
    public function dailyRevenue();
    public function monthlyRevenue();
    public function weeklyRevenue();
}