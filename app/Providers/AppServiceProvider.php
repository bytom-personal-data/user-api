<?php

namespace App\Providers;

use App\Services\Auth\ApiAuth;
use App\Services\Bytom\Node;
use App\Services\Data\Storing;
use App\Services\Secure\Hashing;
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
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Node::class, function($app) {
            return new Node();
        });

        $this->app->singleton(ApiAuth::class, function($app) {
           return new ApiAuth();
        });

        $this->app->singleton(Storing::class, function($app) {
           return new Storing();
        });

        $this->app->singleton(Hashing::class, function($app) {
            return new Hashing();
        });
    }
}
