<?php

namespace App\Http\Resources\Api\Zone;

use App\Http\Resources\Api\AddOn\AddOnResource;
use App\Models\AddOn;
use App\Models\Favourite;
use Illuminate\Http\Resources\Json\JsonResource;

class ZoneResource extends JsonResource
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
            "name" => $this->name ,
            "coordinates" => $this->coordinates ? $this->coordinates[0]->toArray()['coordinates'] : [],
            "latitude" => $this->latitude,
            "longitude" =>  $this->longitude,
            "countryName" => $this->Country ? $this->Country->name : '--',
        ];
    }
}
