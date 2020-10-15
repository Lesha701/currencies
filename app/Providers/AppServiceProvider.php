<?php

namespace App\Providers;

use app\Repositories\CurrencyRepository;
use App\Services\HtmlCurrencyParser;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(HtmlCurrencyParser::class);
        $this->app->singleton(CurrencyRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
