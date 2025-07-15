<?php

namespace App\Providers;

use App\Interfaces\PurchaseInterface;
use App\Interfaces\RevenueSummaryInterface;
use App\Interfaces\SaleInterface;
use App\Interfaces\StockManagementInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryImplementation;
use App\Services\Product\ProductService as ProductProductService;
use App\Services\Product\ProductServiceImplementation;
use App\Services\PurchaseService;
use App\Services\RevenueSummaryService;
use App\Services\SaleService;
use App\Services\StockManagementService;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //interface binding
        $this->app->bind(ProductProductService::class,ProductServiceImplementation::class);
        $this->app->bind(ProductRepository::class,ProductRepositoryImplementation::class);
        $this->app->bind(StockManagementInterface::class,StockManagementService::class);
        $this->app->bind(SaleInterface::class,SaleService::class);
        $this->app->bind(RevenueSummaryInterface::class,RevenueSummaryService::class);
        $this->app->bind(PurchaseInterface::class,PurchaseService::class);
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
                return response()->error($request, $key, 'Too Many Attempts', HttpFoundationResponse::HTTP_TOO_MANY_REQUESTS);
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
