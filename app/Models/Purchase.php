<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'product_code_id',
        'purchase_price',
        'quantity',
    ];

    public function productCodeId()
    {
        return $this->belongsTo(Product::class);
    }
}
