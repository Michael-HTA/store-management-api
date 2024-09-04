<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Services\RevenueSummaryService;
use Illuminate\Support\Facades\Cache;

class ProcessRevenueCalculation implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    
    /**
     * The number of seconds after which the job's unique lock will be released.
     *
     * @var int
     */

    public $uniqueFor = 3600;

    /**
     * Create a new job instance.
     */

    public function __construct(public string $method)
    {
        
    }

    public function uniqueId()
    {
        return $this->method;
    }

    /**
     * Execute the job.
     */
    public function handle(RevenueSummaryService $revenue): void
    {   
        $methodName = $this->method;
        Cache::store('redis')->put($methodName,$revenue->$methodName(),3600);
    }
}
