<?php

namespace App\Providers;

use App\Repositories\Interfaces\IUserRepo;
use App\Services\AuthenticationService;
use App\Services\Interfaces\IAuthService;
use App\Services\Interfaces\IUserService;
use App\Services\UserService;
use App\Repositories\UserRepository;
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
        $this->app->bind(IUserRepo::class, UserRepository::class);
        $this->app->bind(IAuthService::class, AuthenticationService::class);
        $this->app->bind(IUserService::class, UserService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
