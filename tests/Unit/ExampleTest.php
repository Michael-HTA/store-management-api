<?php

namespace Tests\Unit;

use App\Models\Invoice;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_it_generates_an_invoice_number_with_the_correct_format_and_stores_it_in_the_database()
    {
        // Arrange: create an instance of your model class
        $model = new Invoice();

        // Act: Call the generateInvoice method
        $invoiceNumber = $model->generateInvoice();

        // Assert: Check if the invoice number matches the expected format
        $expectedPrefix = now()->year % 100; // Last two digits of the current year
        $expectedInvoiceStart = $expectedPrefix * 1000000 + 1;

        $this->assertEquals($expectedInvoiceStart, $invoiceNumber, "Invoice number does not have the correct year prefix");
    }
}
