<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "product_code_id" => $this->product_code_id,
            "base_price" => $this->base_price,
            "sale_price" => $this->sale_price,
            "quantity" => $this->quantity,
            "invoice_number_id" => $this->invoice_number_id,
        ];
    }
}
