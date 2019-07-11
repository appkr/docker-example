<?php

namespace App;

use Illuminate\Contracts\Cache\Repository;
use Psr\Log\LoggerInterface;

class UserObserver
{
    private $cache;
    private $logger;

    public function __construct(Repository $cache, LoggerInterface $logger)
    {
        $this->cache = $cache;
        $this->logger = $logger;
    }

    public function saved(User $model)
    {
        $this->logger->info("Flushing cache");
        $this->cache->forget("*");
    }
}