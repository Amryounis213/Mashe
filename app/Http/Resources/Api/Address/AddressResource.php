<?php

namespace App\Http\Resources\Api\Address;

use App\Http\Resources\Api\Services\ServiceResource;
use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'name' => $this->address,
            'address_type'=> $this->address_type ,
        ];
       
    }
}
