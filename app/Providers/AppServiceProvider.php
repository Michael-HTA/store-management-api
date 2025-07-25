<?php

namespace App\Providers;

use App\Repositories\Purchase\PurchaseRepository;
use App\Repositories\Purchase\PurchaseRepositoryImplementation;
use App\Repositories\Stock\StockRepository;
use App\Repositories\Stock\StockRepositoryImplementation;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryImplementation;
use App\Repositories\Revenue\RevenueRepository;
use App\Repositories\Revenue\RevenueRepositoryImplemenation;
use App\Repositories\Sale\SaleRepository;
use App\Repositories\Sale\SaleRepositoryImplementation;
use App\Services\Product\ProductService;
use App\Services\Product\ProductServiceImplementation;
use App\Services\Purchase\PurchaseService;
use App\Services\Purchase\PurchaseServiceImplementation;
use App\Services\Revenue\RevenueService;
use App\Services\Stock\StockService;
use App\Services\Stock\StockServiceImplementation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;
use App\Services\Cache\CacheInterface;
use App\Services\Cache\RedisCacheService;
use App\Services\Revenue\RevenueServiceImplementation;
use App\Services\Sale\SaleService;
use App\Services\Sale\SaleServiceImplementation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //interface binding
        $this->app->bind(ProductService::class,ProductServiceImplementation::class);
        $this->app->bind(ProductRepository::class,ProductRepositoryImplementation::class);
        $this->app->bind(StockRepository::class,StockRepositoryImplementation::class);
        $this->app->bind(StockService::class,StockServiceImplementation::class);
        $this->app->bind(SaleService::class,SaleServiceImplementation::class);
        $this->app->bind(RevenueService::class,RevenueServiceImplementation::class);
        $this->app->bind(PurchaseService::class,PurchaseServiceImplementation::class);
        $this->app->bind(PurchaseRepository::class,PurchaseRepositoryImplementation::class);
        $this->app->bind(CacheInterface::class,RedisCacheService::class);
        $this->app->bind(RevenueRepository::class, RevenueRepositoryImplemenation::class);
        $this->app->bind(SaleRepository::class, SaleRepositoryImplementation::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {


        RateLimiter::for('api', function (Request $request) {

            // $token = $request->bearerToken();

            $key = $request->ip() . $request->path();

            return Limit::perMinute(10)->by($key)->response(function(Request $request) use ($key){
                return Response::error($request, $key, 'Too Many Attempts', HttpFoundationResponse::HTTP_TOO_MANY_REQUESTS);
            });
        });

        //custom response
        Response::macro('error', function (Request $request, $data, $message = null, $code = 400) {
            $meta = [
                'method' => $request->getMethod(),
                'endpoint' => $request->path(),
            ];

            $responseData = [
                'success' => 0,
                'code' => $code,
                'meta' => $meta,
                'data' => $data,
                'message' => $message,
            ];

            return Response::json($responseData, $code);
        });

        Response::macro('success', function (Request $request, $data, $message = null, $code = 200) {
            $meta = [
                'method' => $request->getMethod(),
                'endpoint' => $request->path(),
            ];

            $responseData = [
                'success' => 1,
                'code' => $code,
                'meta' => $meta,
                'data' => $data,
                'message' => $message,
            ];

            return Response::json($responseData, $code);
        });
    }
}
