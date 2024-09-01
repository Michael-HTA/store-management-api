<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->whenHas('name'),
            'product_code_id'=> $this->product_code_id,
            'purchase_price' => $this->purchase_price,
            'quantity'  => $this->quantity,
        ];
    }
}
