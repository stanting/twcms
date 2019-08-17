<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\Http\View\Creators\NavCreator;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::creator('admin.*', NavCreator::class);
    }
}
