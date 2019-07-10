<?php

namespace App\Providers;

use App\Service\ConcreteUserService;
use App\Service\LoggableService;
use App\Service\TransactionalUserService;
use App\Service\UserService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(UserService::class, function (Application $app) {
            $delegate = $app->make(ConcreteUserService::class);
            $connection = $app->make(ConnectionInterface::class);
            $logger = $app->make(LoggerInterface::class);

            return new LoggableService(
                new TransactionalUserService($delegate, $connection),
                $logger
            );
        });
    }
}
