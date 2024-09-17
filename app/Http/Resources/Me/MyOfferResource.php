<?php

namespace App\Http\Resources\Me;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MyOfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'my_offer'  => $this->itemBidding->where('buyer_id', auth()->user()->id)->first()
        ]);
    }
}
