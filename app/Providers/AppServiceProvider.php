<?php

namespace App\Providers;

use App\Models\Access;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route; // important for checking route names

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
        // Use Bootstrap for pagination
        Paginator::useBootstrap();

        // Conditionally inject 'accesses' only if not using a plain layout route
        View::composer('*', function ($view) {
            if (auth()->check()) {
                // Routes that use 'layouts.plain' and should NOT have sidebar
                $plainLayoutRoutes = [
                    'score-categories.*',
                    'attendance.*',
                    'profile.*',
                ];

                foreach ($plainLayoutRoutes as $pattern) {
                    if (Route::is($pattern)) {
                        return; // Do not inject 'accesses'
                    }
                }

                // Inject sidebar access data
                $accesses = resolve(Access::class)->get(true);
                $view->with('accesses', $accesses);
            }
        });
    }
}
