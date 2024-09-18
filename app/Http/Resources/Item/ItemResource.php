<?php

namespace App\Http\Resources\Item;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return  [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'item_name' => $this->item_name,
            'item_description' => $this->item_description,
            'images' => $this->itemImage,
            'has_offer' => $this->has_offer,
            'is_bid' => $this->is_bid,
            'price' => $this->price,
            'total_fee' =>  $this->total_fee,
            'total_fee_breakdown' =>  $this->total_fee_breakdown,
            'user' => $this->user,
            'category' => $this->subCategory->category,
            'my_offer' => (auth('auth-api')->check()) ? $this->itemBidding->where('buyer_id', auth('auth-api')->user()->id)->where('is_accepted', 1)->first() : ''
        ];
    }
}
