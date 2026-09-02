<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Passport::ignoreRoutes();
        Passport::enablePasswordGrant();

        Passport::tokensExpireIn(Carbon::now()->addHours(12));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
    }
}
