<?php

namespace App\Providers;

use App\Product\ProductService;
use App\Product\ProductServiceFactory;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(
            ProductService::class,
            function () {
                return ProductServiceFactory::create(config('product-service', []), new Client(['http_errors'=>false]));
            }
        );
    }
}
