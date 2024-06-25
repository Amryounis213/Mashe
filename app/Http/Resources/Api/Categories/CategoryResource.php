<?php

namespace App\Http\Resources\Api\Categories;

use App\Http\Resources\Api\Foods\FoodResource;
use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'image'=> dynamicStorage('storage/app/public/category/').'/'.$this['image'] ,
        ];
    }
}
