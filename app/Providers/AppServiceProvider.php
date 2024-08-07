<?php

namespace App\Providers;

use App\Interfaces\ProductInterface;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {   
        //interface binding
        $this->app->bind(ProductInterface::class,ProductService::class);

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
