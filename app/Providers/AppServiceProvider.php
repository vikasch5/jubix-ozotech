<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        View::composer('frontend.*', function ($view) {
            $categories = Category::with('subCategories')->where('status', '1')->get();
            $services = Service::where('status', '1')->get();
            $settings = Setting::first();
            $view->with([
                'categories' => $categories,
                'services' => $services,
                'settings' => $settings,

            ]);
        });
    }
}
