<?php

namespace App\Services\Cache;

interface CacheInterface
{
    public function remember($key, $ttl, $callback);
}
