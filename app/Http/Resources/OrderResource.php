<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                 => $this->id,
            'transaction_number' => $this->transaction_number,

            'cashier_name'       => $this->whenLoaded('cashier', $this->cashier->name),

            'total_price'        => (float) $this->total_price,
            'total_item'         => (int) $this->total_item,
            'payment_method'     => $this->payment_method,
            'transaction_time'   => $this->created_at->format('Y-m-d H:i:s'),

            'items'              => OrderItemResource::collection($this->whenLoaded('orderItems')),
        ];
    }
}
