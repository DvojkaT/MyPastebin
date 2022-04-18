<?php

namespace App\Providers;

use App\Repositories\Abstracts\PasteRepository;
use App\Repositories\Abstracts\UserRepository;
use App\Repositories\PasteRepositoryEloquent;
use App\Repositories\UserRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /** @var array */
    protected $repositories = [
        PasteRepository::class => PasteRepositoryEloquent::class,
        UserRepository::class => UserRepositoryEloquent::class,
    ];
    /**
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $abstract => $concrete) {
            $this->app->singleton($abstract, $concrete);
        }
    }

    public function boot()
    {

    }
}
