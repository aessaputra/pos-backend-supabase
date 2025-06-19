<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'product_name' => $this->whenLoaded('product', $this->product->name),
            'quantity'     => $this->quantity,
            'price'        => $this->whenLoaded('product', $this->product->price),
            'total_price'  => $this->total_price,
        ];
    }
}
