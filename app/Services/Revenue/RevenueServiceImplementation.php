<?php
namespace App\Services\Revenue;

use App\Repositories\Revenue\RevenueRepository;
use App\Services\Cache\CacheInterface;
use Carbon\Carbon;

class RevenueServiceImplementation implements RevenueService{
    public function __construct(
        protected RevenueRepository $revenueRepository, 
        protected Carbon $carbon, 
        protected CacheInterface $cache){}

    public function generateRevenue($start,$end){

        $start = $this->carbon->now()->$start();
        $end = $this->carbon->now()->$end();

        return $this->revenueRepository->generateRevenue($start,$end);
    }

    public function dailyRevenue(){

        $key = "dailyRevenue";

        return $this->cache->remember($key,600, function(){
            return $this->generateRevenue("startofday","endofday");
        });
    }

    public function monthlyRevenue(){

        $key = "monthlyRevenue";

        return $this->cache->remember($key,600, function(){
            return $this->generateRevenue("startofmonth","endofmonth");
        });
    }

    public function weeklyRevenue(){

        $key = "weeklyRevenue";

        return $this->cache->remember($key,600, function(){
            return $this->generateRevenue("startofweek","endofweek");
        });
        
    }
}