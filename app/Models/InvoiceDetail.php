<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;

    public $fillable = [
        'invoice_number_id',
        'product_code_id',
        'price',
        'quantity',
    ];
}
