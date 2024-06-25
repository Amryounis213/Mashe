<?php

namespace App\Http\Resources\Api\Banners;

use App\Http\Resources\Api\Foods\FoodResource;
use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;

class BannersResource extends JsonResource
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
            'title' => $this->title,
            'image'=> dynamicStorage('storage/app/public/banners/').'/'.$this['image'] ,
        ];
    }
}
