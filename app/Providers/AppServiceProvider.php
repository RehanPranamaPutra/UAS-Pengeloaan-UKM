<?php

namespace App\Providers;

use App\Models\Ukm;
use App\Models\User;
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

        Gate::define('crud',function($user, Ukm $ukm){
            return $user->role === 'admin' || $user->ukm_id === $ukm->id;
        });

        Gate::define('create-ukm',function($user){
            return $user->role === 'admin';
        });

        Gate::define('create-user',function($user){
            return $user->role === 'admin';
        });

        Gate::define('role-user',function($user, User $pengelola){
            if($user->role === 'admin'){
                return true;
            }
            return $user->id === $pengelola->id;
        });
    }
}
