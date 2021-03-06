<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('books_create', function (User $user) { return $user->is_admin; } );
        Gate::define('books_edit', function (User $user) { return $user->is_admin; } );
        Gate::define('books_delete', function (User $user) { return $user->is_admin; } );
        Gate::define('books_status', function (User $user) { return $user->is_admin; });

        //
    }
}
