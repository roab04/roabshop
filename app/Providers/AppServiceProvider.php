<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator as PaginationPaginator;
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
        view()->composer('*', function($view){
            $categories = Category::all();
            $view->with('categories', $categories);
        });
        PaginationPaginator::useBootstrapFive();
    }
}