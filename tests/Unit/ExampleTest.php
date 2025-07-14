<?php

namespace Tests\Unit;

use App\Models\Invoice;
use Tests\TestCase;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Pagination\LengthAwarePaginator;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    // public function test_it_generates_an_invoice_number_with_the_correct_format_and_stores_it_in_the_database()
    // {
    //     // Arrange: create an instance of your model class
    //     $model = new Invoice();

    //     // Act: Call the generateInvoice method
    //     $invoiceNumber = $model->generateInvoice();

    //     // Assert: Check if the invoice number matches the expected format
    //     $expectedPrefix = now()->year % 100; // Last two digits of the current year
    //     $expectedInvoiceStart = $expectedPrefix * 1000000 + 3;

    //     $this->assertEquals($expectedInvoiceStart, $invoiceNumber, "Invoice number does not have the correct year prefix");
    // }
    // public function test_that_true_is_true(): void
    // {
    //     $this->assertTrue(true);
    // }

    public function test_product_searching()
    {
        $id = "P0001";

        $productService = new ProductService(new Product());

        $result = $productService->getProductByProductCode($id);

        $this->assertInstanceOf(Product::class, $result);

        $this->assertEquals($result->product_code, $id);
    }

    public function test_get_product_list()
    {

        $productService = new ProductService(new Product());

        $paginatedProducts = $productService->getProduct();

        $this->assertInstanceOf(LengthAwarePaginator::class, $paginatedProducts);

        // Assert that the paginator contains Product models
        $this->assertInstanceOf(Product::class, $paginatedProducts[0]);
    }
}
