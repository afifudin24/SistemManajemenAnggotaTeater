<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use App\Models\Pembina;

class AppServiceProvider extends ServiceProvider {
    /**
    * Register any application services.
    */

    public function register(): void {
        //
    }

    /**
    * Bootstrap any application services.
    */

    public function boot(): void {
        Paginator::useBootstrap();
        Carbon::setLocale( 'id' );
        View::composer('partials.sidebar', function ($view) {
            $datapembina = Pembina::where('status', '1')->get();
            $view->with('datapembina', $datapembina);
        });

        // untuk Bootstrap 4
    }
}
