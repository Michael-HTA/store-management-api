<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Product;
use App\Services\ProductService;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_redis_api_route(): void
    {
        $response = $this->get('/api/redis');

        $response->assertJson(['msg' => 'Hello world']);
    }
}
