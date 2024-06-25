<?php

namespace App\Http\Resources\Api\Foods;

use App\Http\Resources\Api\AddOn\AddOnResource;
use App\Models\AddOn ;
use App\Models\Favourite;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
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
            'image' => dynamicStorage('storage/app/public/product').'/'.$this['image'],
            'description' => $this->description,
            'price'=> $this->price,
            'rating_count'=> $this->rating_count ,
            'rating_avg'=> $this->avg_rating ,
            'is_favourite' => Favourite::where('user_id' , auth()->user('api')->id)->where('food_id' , $this->id)->exists(),
            'addons'=> AddOnResource::collection(AddOn::where('restaurant_id' , $this->restaurant_id)->get()),
        ];
       
    }
}
