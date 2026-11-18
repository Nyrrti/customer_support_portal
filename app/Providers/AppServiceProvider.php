<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;


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
        JsonResource::withoutWrapping();

        // Send the reset link to the Vue page instead of a Laravel route.
        ResetPassword::createUrlUsing(function (User $user, string $token) {
            return config("app.url") . "/reset-password?token=" . $token
                . "&email=" . urlencode($user->getEmailForPasswordReset());
        });
    }
}
