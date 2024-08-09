<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class InvoiceDetailCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function __construct($collection , public $code = 200, public $message = null)
    {
        parent::__construct($collection);
    }

    public function toArray(Request $request): array
    {
        $meta = [
            'method' => $request->getMethod(),
            'endpoint' => $request->path(),
        ];

        return [
            'success' => 1,
            'code' => $this->code,
            'meta' => $meta,
            'data' => $this->collection,
            'message' => $this->message,
        ];
    }
}
