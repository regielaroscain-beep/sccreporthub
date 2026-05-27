<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResendTransport;
use Symfony\Component\Mailer\Transport\Dsn;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Register Resend HTTP transport
        Mail::extend('resend', function () {
            return new ResendTransport(env('RESEND_API_KEY', ''));
        });
    }

    public function boot(): void
    {
        // Force HTTPS on production (Railway, etc.)
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // Ensure storage directories exist
        $dirs = [
            storage_path('framework/views'),
            storage_path('framework/sessions'),
            storage_path('framework/cache/data'),
            storage_path('logs'),
        ];
        foreach ($dirs as $dir) {
            if (!is_dir($dir)) {
                mkdir($dir, 0775, true);
            }
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
