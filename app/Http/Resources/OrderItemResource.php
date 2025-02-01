<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product' => ProductResource::make($this->product),
            'product_model' => ProductResource::make($this->product_model),
            'price'=>$this->price,
            'quantity'=>$this->quantity,
            'total'=>$this->total,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at
        ];
    }
}
