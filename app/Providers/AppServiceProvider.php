<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\AboutRepositoryInterface;
use App\Repositories\Eloquents\OrmAboutRepository;
use App\Repositories\DB\DbAboutRepository;
use App\Repositories\Contracts\TeamsRepositoryInterface;
use App\Repositories\Eloquents\OrmTeamsRepository;

use App\ProductType;
use Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('header', function ($view) {
            $productType = ProductType::where('is_deleted', 0)->get();
            $cart = Cart::content();
            $countCart = Cart::count();
            $totalCart = Cart::subtotal(0);
            $view->with(['productType' => $productType, 'cart' => $cart, 'countCart' => $countCart, 'totalCart' => $totalCart]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AboutRepositoryInterface::class, OrmAboutRepository::class);
        // $this->app->singleton(AboutRepositoryInterface::class, DbAboutRepository::class);
        $this->app->singleton(TeamsRepositoryInterface::class, OrmTeamsRepository::class);
    }
}
