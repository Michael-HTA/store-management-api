<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'manufacturing_date' => $this->manufacturing_date,
            'expiry_date' => $this->expiry_date,
            'product_code' => $this->product_code,
            'base_price' => $this->base_price,
            'sale_price' => $this->sale_price,
            'stock' => new StockResource($this->whenLoaded('stock')),
            'manufacturer' => new ManufacturerResource($this->whenLoaded('manufacturer')),
            'supplier' => new SupplierResource($this->whenLoaded('supplier')),
            'model_form' => new ModelFormResource($this->whenLoaded('modelForm')),
            'category' => new CategoryResource($this->whenLoaded('category')),
        ];
    }
}
