<?php

namespace App\Providers;

use App\Services\Stream\StreamNotifier;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(StreamNotifier::class, fn () => new StreamNotifier(
            (string) config('stream.control_url'),
            (string) config('stream.control_token'),
        ));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
