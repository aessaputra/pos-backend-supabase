<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'price'       => $this->price,
            'image_url'   => $this->image_url,
            'category'    => new CategoryResource($this->whenLoaded('category')),
            'created_at'  => $this->created_at->toDateTimeString(),
        ];
    }
}
