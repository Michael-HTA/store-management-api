<?php
namespace App\Repositories\Revenue;

interface RevenueRepository{
    public function generateRevenue($start,$end);
}