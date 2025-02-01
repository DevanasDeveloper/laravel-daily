<?php

namespace App\Providers;
    
use App\Repositories\UserRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\OrderRepository;
use App\Repositories\OrderItemRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\OrderItemRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // bind user interface to user repository 
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
        // bind customer interface to customer repository 
        $this->app->bind(
            CustomerRepositoryInterface::class,
            CustomerRepository::class
        );
        // bind category interface to category repository 
        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );
        // bind product interface to product repository 
        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );
         // bind order interface to order repository 
         $this->app->bind(
            OrderRepositoryInterface::class,
            OrderRepository::class
        );
        // bind order item interface to order item repository 
        $this->app->bind(
            OrderItemRepositoryInterface::class,
            OrderItemRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
