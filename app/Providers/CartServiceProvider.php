<?php

namespace App\Providers;

use App\Cart\CartService;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    private $projectName = 'cart';

    public function register(): void
    {
        $this->app->singleton(CartService::class, function () {
            return new CartService();
        });

        $this->mergeConfig();
    }

    public function boot(): void
    {
        $this->publishConfig();
    }

    private function mergeConfig(): void
    {
        $path = $this->getConfigPath();
        $this->mergeConfigFrom($path, $this->projectName);
    }

    private function publishConfig(): void
    {
        $path = $this->getConfigPath();
        $this->publishes([$path => config_path(sprintf('%s.php', $this->projectName))], 'config');
    }

    private function getConfigPath(): string
    {
        return __DIR__ . sprintf('/../../config/%s.php', $this->projectName);
    }
}
