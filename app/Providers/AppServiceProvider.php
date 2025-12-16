<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\NewsObserver;
use App\Observers\CategoryObserver;
use App\Observers\AuthorObserver;
use App\Models\News;
use App\Models\Category;
use App\Models\Author;


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
        News::observe(NewsObserver::class);
        Category::observe(CategoryObserver::class);
        Author::observe(AuthorObserver::class);
    }
}
