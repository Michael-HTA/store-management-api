<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Pagination\LengthAwarePaginator;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    // public function test_that_true_is_true(): void
    // {
    //     $this->assertTrue(true);
    // }

    public function test_product_searching(){
        $id = "P0001";

        $productService = new ProductService(new Product());

        $result = $productService->getProductByProductCode($id);

        $this->assertInstanceOf(Product::class,$result);

        $this->assertEquals($result->product_code, $id);
    }

    public function test_get_product_list(){

        $productService = new ProductService(new Product());

        $paginatedProducts = $productService->getProduct();

        $this->assertInstanceOf(LengthAwarePaginator::class, $paginatedProducts);

    // Assert that the paginator contains Product models
        $this->assertInstanceOf(Product::class, $paginatedProducts[0]);
    }
}
