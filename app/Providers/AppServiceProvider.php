<?php

namespace App\Providers;

use App\Repositories\RoleRepository;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use PDepend\Application;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {
        $roleRepository = new RoleRepository($this->app);

        $roleLevels = $roleRepository->getRoleLevels();

        View::share([
            'roleLevels'    => $roleLevels,
            ]);
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
