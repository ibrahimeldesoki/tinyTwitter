<?php


namespace App\Providers;

use App\Services\UserService;
use App\Utils\JWTAppAuth;
use Illuminate\Support\ServiceProvider;

class JWTServiceProvider extends ServiceProvider
{
    protected function registerJWTAuth()
    {
        $this->app->singleton('tymon.jwt.auth', function ($app) {
            return (new JWTAppAuth(app(UserService::class),
                $app['tymon.jwt.manager'],
                $app['tymon.jwt.provider.auth'],
                $app['tymon.jwt.parser']
            ))->lockSubject($this->config('lock_subject'));
        });
    }

    protected function config($key, $default = null)
    {
        return config("jwt.$key", $default);
    }
}
