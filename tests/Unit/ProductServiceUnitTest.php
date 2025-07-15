<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PHPUnit\Framework\TestCase;
use Mockery;

class ProductServiceUnitTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    protected function tearDown(): void
    {
        Mockery::close(); // Clean up mock objects
    }

    public function test_get_product_by_product_code_returns_product()
    {
        $mockProduct = Mockery::mock(Product::class);
        $productCode = 'P0001';
        $expectedProduct = new Product(['product_code' => $productCode]);

        // Mock the behavior of the where + firstOrFail chain
        $mockProduct
            ->shouldReceive('where')
            ->with('product_code', $productCode)
            ->once()
            ->andReturnSelf();

        $mockProduct
            ->shouldReceive('firstOrFail')
            ->once()
            ->andReturn($expectedProduct);

        $service = new ProductService($mockProduct);

        $result = $service->getProductByProductCode($productCode);

        $this->assertSame($expectedProduct, $result);
    }

    public function test_get_product_by_product_code_throws_exception_if_not_found()
    {
        $this->expectException(ModelNotFoundException::class);

        $mockProduct = Mockery::mock(Product::class);
        $productCode = 'NOT_FOUND';

        $mockProduct
            ->shouldReceive('where')
            ->with('product_code', $productCode)
            ->once()
            ->andReturnSelf();

        $mockProduct
            ->shouldReceive('firstOrFail')
            ->once()
            ->andThrow(ModelNotFoundException::class);

        $service = new ProductService($mockProduct);

        $service->getProductByProductCode($productCode);
    }
}
