<?php

namespace App\Providers;

use App\Contexts\ClientContext;
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
        $this->app['context'] = $this->app->share(function($app)
        {
            return new ClientContext;
        });

        $this->app->bind('App\Contexts\Context', function($app)
        {
            return $app['context'];
        });

        //User Repository
        $this->app->bind(
            'App\Domain\Models\Identity\UserRepository',
            'App\Infrastructure\Repositories\UserEloquentRepository'
        );

        //Product Repository
        $this->app->bind(
            'App\Domain\Models\Product\ProductRepository',
            'App\Infrastructure\Repositories\ProductEloquentRepository'
        );

        //Project Repository
        $this->app->bind(
            'App\Domain\Models\Project\ProjectRepository',
            'App\Infrastructure\Repositories\ProjectEloquentRepository'
        );

        //Tag Repository
        $this->app->bind(
            'App\Domain\Models\Tag\TagRepository',
            'App\Infrastructure\Repositories\TagEloquentRepository'
        );
    }
}
