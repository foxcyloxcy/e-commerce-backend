<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Passport::tokensExpireIn(now()->addMonths(36));
        Passport::refreshTokensExpireIn(now()->addMonths(36));
        Passport::personalAccessTokensExpireIn(now()->addMonths(36));

        Passport::tokensCan([
            'auth-api' => 'Users',
            'auth-api-admin' => 'Admin Users'
        ]);
    }
}
