<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Blade;
use Illuminate\Pagination\Paginator;
use App\Models\Category;
use Illuminate\Support\Facades\View;
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
        Blade::directive('activeRoute', function ($route) {
            return "<?php echo request()->routeIs($route) ? 'active' : ''; ?>";
        });    

          Paginator::useBootstrapFive();

        View::composer('layouts.app', function ($view) {
            $layoutCategories = Category::where('status', 1)
                ->orderBy('name')
                ->get(['id', 'name', 'slug']);

            $view->with('layoutCategories', $layoutCategories);
        });
        
    }
}
