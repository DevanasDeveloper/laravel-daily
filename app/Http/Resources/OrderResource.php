<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'customer' => CustomerResource::make($this->customer),
            'order_items' => OrderItemResource::collection($this->order_items)->toArray(request()),
            'total'=>$this->total,
            'status' => $this->status->value,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at
        ];
    }
}
