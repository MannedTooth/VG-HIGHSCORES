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

        //Attempts
        Gate::define('create-attempts', 'App\Policies\AttemptsPolicy@create');
        Gate::define('edit-attempts', 'App\Policies\AttemptsPolicy@edit');
        Gate::define('delete-attempts', 'App\Policies\AttemptsPolicy@delete');

        //Games
        Gate::define('create-games', 'App\Policies\GamesPolicy@create');
        Gate::define('edit-games', 'App\Policies\GamesPolicy@edit');
        Gate::define('delete-games', 'App\Policies\GamesPolicy@delete');

        //Genres
        Gate::define('create-genres', 'App\Policies\GenresPolicy@create');
        Gate::define('edit-genres', 'App\Policies\GenresPolicy@edit');
        Gate::define('delete-genres', 'App\Policies\GenresPolicy@delete');

        //Records
        Gate::define('create-records', 'App\Policies\RecordsPolicy@create');
        Gate::define('edit-records', 'App\Policies\RecordsPolicy@edit');
        Gate::define('delete-records', 'App\Policies\RecordsPolicy@delete');
    }
}
