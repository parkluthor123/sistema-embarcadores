<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

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
        Gate::define('is_authenticated', function ($auth = null) {
            return Auth::guard('employees')->check();
        });

        Gate::define('is_admin', function ($auth = null) {
            return Auth::guard('employees')->user()->is_admin == 1;
        });

        Gate::define('embarcadora', function ($auth = null) {
            return Auth::guard('employees')->user()->role === 'embarcadora';
        });
        
        Gate::define('transportadora', function ($auth = null) {
            return Auth::guard('employees')->user()->role === 'transportadora';
        });
    }
}
