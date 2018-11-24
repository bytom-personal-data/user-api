<?php

namespace App\Providers;

use App\Repositories\UserRepository;
use App\Services\Auth\ApiAuth;
use App\Services\Bytom\Node;
use Illuminate\Support\Facades\Auth;
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
    }
}
