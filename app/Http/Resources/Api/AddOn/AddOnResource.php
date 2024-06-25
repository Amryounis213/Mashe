<?php

namespace App\Http\Resources\Api\AddOn;

use App\Models\AddOn ;
use App\Models\Favourite;
use Illuminate\Http\Resources\Json\JsonResource;

class AddOnResource extends JsonResource
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
            'image' => dynamicStorage('storage/app/public/addon').'/'.$this['image'],
            'price'=> $this->price,
        ];
       
    }
}
