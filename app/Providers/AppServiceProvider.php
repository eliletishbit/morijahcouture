<?php

namespace App\Providers;
use App\Models\Categorie;
use App\Models\Collection;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Vite;
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
        Vite::prefetch(concurrency: 3);

        if (request()->header('x-forwarded-proto') === 'https') {
        URL::forceScheme('https');
        }

        // View::composer('partials.header-frontend', function ($view) {
        // $view->with('categories', Categorie::all());
        // });
        View::composer('*', function ($view) {
        $view->with('categories', Categorie::all());
        });

        View::composer(['partials.header-frontend', 'partials.sidebar-frontend'], function ($view) {
        $collections = Collection::all();
        $view->with('collections', $collections);
    });

   

    
    }
}
