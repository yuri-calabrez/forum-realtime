<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Reply;
use App\Observers\ReplyObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Schema::defaultStringLength(191);

        Reply::observe(ReplyObserver::class);
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
