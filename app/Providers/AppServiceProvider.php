<?php

namespace App\Providers;

use App\Models\Page;
use App\Models\PageVariable;
use App\Models\ProductType;
use App\Models\Variable;
use App\Observers\PageObserver;
use App\Observers\PageVariableObserver;
use App\Observers\ProductTypeObserver;
use App\Observers\VariableObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Page::observe(PageObserver::class);
        PageVariable::observe(PageVariableObserver::class);
        ProductType::observe(ProductTypeObserver::class);
        Variable::observe(VariableObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }
}
