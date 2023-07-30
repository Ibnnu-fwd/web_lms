<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(\App\Interfaces\VerificatorInterface::class, \App\Repositories\VerificatorRepository::class);
        $this->app->bind(\App\Interfaces\UserInterface::class, \App\Repositories\UserRepository::class);
        $this->app->bind(\App\Interfaces\CourseCategoryInterface::class, \App\Repositories\CourseCategoryRepository::class);
        $this->app->bind(\App\Interfaces\CourseInterface::class, \App\Repositories\CourseRepository::class);
        $this->app->bind(\App\Interfaces\CourseChapterInterface::class, \App\Repositories\CourseChapterRepository::class);
        $this->app->bind(\App\Interfaces\MinCoursePurchaseAtRegInterface::class, \App\Repositories\MinCoursePurchaseAtRegRepository::class);
        $this->app->bind(\App\Interfaces\CourseSubChapterInterface::class, \App\Repositories\CourseSubChapterRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
