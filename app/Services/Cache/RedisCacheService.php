<?php
namespace App\Services\Cache;
use Illuminate\Support\Facades\Cache;
use App\Services\Cache\CacheInterface;

class RedisCacheService implements CacheInterface
{
    public function remember($key, $ttl, $callback)
    {
        return Cache::store('redis')->remember($key, $ttl, $callback);
    }
}