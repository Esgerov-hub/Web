<?php

namespace App\Providers;

use App\Http\ComposerView;
use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposer;

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
        view()->composer('layouts.dashboard', ViewComposer::class);
        view()->composer(['layouts.app','weblabs.contact','weblabs.about'], ComposerView::class);
    }
}
