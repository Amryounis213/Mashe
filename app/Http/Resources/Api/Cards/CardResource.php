<?php

namespace App\Http\Resources\Api\Cards;

use App\Http\Resources\Api\AddOn\AddOnResource;
use App\Models\AddOn;
use App\Models\Favourite;
use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "expYear" => $this->Tyear,
            "expMonth" => $this->Tmonth,
            "l4digit" => $this->last_4_digits,
            "issuer" => $this->issuer,
            "cardName" => $this->holder_name,
            "isDefault" => (boolean)$this->default,
            // "showInfo" => false,
            // "image" => "images/master-card.png",
        ];
    }
}
