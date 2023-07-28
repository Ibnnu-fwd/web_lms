<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(\App\Interfaces\VerificatorInterface::class, \App\Repositories\VerificatorRepository::class);
        $this->app->bind(\App\Interfaces\UserInterface::class, \App\Repositories\UserRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
