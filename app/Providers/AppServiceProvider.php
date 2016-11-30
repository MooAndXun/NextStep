<?php

namespace App\Providers;

use App\Config\Constant;
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
        // View 共享数据
        view()->share(['current_user'=>session('user')]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'local') {
            $this->app->register('Iber\Generator\ModelGeneratorProvider');
        }

    }
}
