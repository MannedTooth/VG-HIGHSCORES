<?php

namespace App\Providers;

use App\Policies\GenresPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Genre::class => GenresPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('create-genres', 'App\Policies\GenresPolicy@create');
        Gate::define('edit-genres', 'App\Policies\GenresPolicy@edit');
        Gate::define('delete-genres', 'App\Policies\GenresPolicy@delete');
    }
}
