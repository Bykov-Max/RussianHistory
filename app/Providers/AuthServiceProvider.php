<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];


    public function boot()
    {
        $this->registerPolicies();

        Gate::define('edit-post', function($user, $post){
            return $user->id === $post->user_id;
        });

        Gate::define('delete-post', function($user, $post){
            return $user->id === $post->user_id;
        });

        Gate::define('admin', function($user){
            return $user->role->name === "Администратор";
        });

        Gate::define('user', function($user){
            return $user->role_id === 1;
        });

        Gate::define('moderator', function($user){
            return $user->role_id === 3;
        });

        Gate::define('admin-moderator', function($user){
            return $user->role_id === 2 || $user->role_id === 3;
        });
    }
}
