<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Invoice extends Model
{
    use HasFactory;

    public $fillable = [
        'invoice_number',
    ];

    public function invoiceDetail()
    {
        return $this->hasMany(invoiceDetail::class);
    }

    public function generateInvoice()
    {   
        $id = self::max('id') + 1;

        $invoiceNumber = (substr(now()->year, -2)) * 1000000 + $id;

        DB::transaction(function () use ($invoiceNumber) 
        {
            $this->create([
                'invoice_number' => $invoiceNumber,
            ]);

        });

        return $invoiceNumber;
    }
}
