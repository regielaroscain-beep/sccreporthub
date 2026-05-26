<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Force HTTPS on production (Railway, etc.)
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // Share unread notification count with all views
        view()->composer('*', function ($view) {
            if (auth()->check()) {
                $unreadCount = \App\Models\Notification::where('user_id', auth()->id())
                    ->where('is_read', false)
                    ->count();
                $view->with('unreadNotificationCount', $unreadCount);
            }
        });
    }
}
