<?php

namespace App\Providers;

use App\Services\Abstracts\PasteServiceInterface;
use App\Services\Abstracts\UserServiceInterface;
use App\Services\PasteService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected array $services = [
        PasteServiceInterface::class => PasteService::class,
        UserServiceInterface::class => UserService::class
    ];
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->services as $abstract => $concrete) {
            $this->app->singleton($abstract, $concrete);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
