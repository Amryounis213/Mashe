<?php

namespace App\Http\Resources\Api\Restaurants;

use App\Http\Resources\Api\Foods\FoodResource;
use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'foods'=> FoodResource::collection($this->Foods) ,
        ];
    }
}
