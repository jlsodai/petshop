<?php

namespace Julius\CurrencyConvert;

use Illuminate\Support\ServiceProvider;

class CurrencyConvertServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
    }
}
