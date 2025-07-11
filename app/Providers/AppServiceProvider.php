<?php

namespace App\Providers;

use App\Models\Ukm;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        view()->composer('layout.main', function ($view) {
            $view->with('sidebar_ukms', Ukm::all());
        });

        Gate::define('access',function($user,$ukm_id){
            if($user->role === 'admin'){
                return true;
            }
            return $user->ukm_id === $ukm_id;
        });
    }
}
