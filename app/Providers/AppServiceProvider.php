<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\OrderReportService;
use App\Models\Category;
use App\Models\Order;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(OrderReportService::class, function ($app) {
            return new OrderReportService(new Category, new Order);
        });
    }

    public function boot(): void
    {
        //
    }
}