<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => UserPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        // Définir le Gate pour l'accès admin
        Gate::define('access-admin', function (User $user) {
            if (!$user->hasVerifiedEmail()) {
                return false;
            }
            return $user->usertype == '1';
        });
    }
}