<?php

namespace App\Providers;

use App\Service\CacheableUserService;
use App\Service\ConcreteUserService;
use App\Service\LoggableService;
use App\Service\RetryableService;
use App\Service\TransactionalUserService;
use App\Service\UserService;
use App\User;
use App\UserObserver;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(UserService::class, function (Application $app) {
            $concrete = $app->make(ConcreteUserService::class);
            $connection = $app->make(ConnectionInterface::class);
            $logger = $app->make(LoggerInterface::class);
            $cache = $app->make(Repository::class);

            return new CacheableUserService(
                new LoggableService(
                    new RetryableService(
                        new TransactionalUserService($concrete, $connection),
                        $logger
                    ),
                    $logger
                ),
                $cache
            );
        });
    }

    public function boot() {
        User::observe(UserObserver::class);
    }
}
