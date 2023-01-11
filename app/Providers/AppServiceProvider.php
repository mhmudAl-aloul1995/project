<?php

namespace App\Providers;

use App\Version;
use Illuminate\Support\ServiceProvider;
use Schema;
use View;
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
        $lastVersion = Version::latest('id')->first();
        View::share('lastVersion', $lastVersion);

        Schema::defaultStringLength(191);

    }
}
