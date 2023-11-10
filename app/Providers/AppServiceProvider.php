<?php

namespace App\Providers;

use App\Libraries\Interfaces\IProductPrice;
use App\Libraries\ProductPriceFixedVat;
use App\Libraries\ProductPriceIncludedVat;
use App\Libraries\ProductPricePercentageVat;
use App\Repositories\Interfaces\IUserRepo;
use App\Services\AuthenticationService;
use App\Services\Interfaces\IAuthService;
use App\Services\Interfaces\IUserService;
use App\Services\UserService;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CartProductRepository;
use App\Repositories\CartRepository;
use App\Repositories\DbTransactionRepository;
use App\Repositories\Interfaces\ICartProductsRepo;
use App\Repositories\Interfaces\ICartRepo;
use App\Repositories\Interfaces\IDbTransaction;
use App\Repositories\Interfaces\IProductNameRepo;
use App\Repositories\Interfaces\IProductRepo;
use App\Repositories\Interfaces\IStoreRepo;
use App\Repositories\ProductNameRepository;
use App\Repositories\ProductRepository;
use App\Repositories\StoreRepository;
use App\Services\AuthorizationService;
use App\Services\CartPriceService;
use App\Services\CartService;
use App\Services\ProductService;
use App\Services\StoreService;
use App\Services\Interfaces\IAuthorizationService;
use App\Services\Interfaces\ICartPriceService;
use App\Services\Interfaces\ICartService;
use App\Services\Interfaces\IProductService;
use App\Services\Interfaces\IStoreService;

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
        $this->app->bind(IAuthorizationService::class, AuthorizationService::class);
        $this->app->bind(IStoreRepo::class, StoreRepository::class);
        $this->app->bind(IStoreService::class, StoreService::class);
        $this->app->bind(IProductRepo::class, ProductRepository::class);
        $this->app->bind(IProductService::class, ProductService::class);
        $this->app->bind(IProductNameRepo::class, ProductNameRepository::class);
        $this->app->bind(IDbTransaction::class, DbTransactionRepository::class);
        $this->app->bind(ICartRepo::class, CartRepository::class);
        $this->app->bind(ICartProductsRepo::class, CartProductRepository::class);
        $this->app->bind(ICartService::class, CartService::class);
        $this->app->bind(IProductPrice::class, ProductPriceIncludedVat::class);
        $this->app->bind(IProductPrice::class, ProductPriceFixedVat::class);
        $this->app->bind(IProductPrice::class, ProductPricePercentageVat::class);
        $this->app->bind(ICartPriceService::class, CartPriceService::class);
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
