<?php

namespace App\Http\Resources\Api\Restaurants;

use App\Http\Resources\Api\Address\AddressResource;
use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantsResource extends JsonResource
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
            'name' => $this->name ,           
            'logo' => dynamicStorage('storage/app/public/restaurant').'/'.$this['logo'],
            'cover_photo' => dynamicStorage('storage/app/public/restaurant/cover').'/'.$this['cover_photo'],
            'time'=> round($this->delivery_time), 
            'is_open'=> $this->isOpen($this)
        ];
       
    }

    private function isOpen($restaurant) {
        $now = new DateTime(); // Current time
        $openingTime = new DateTime($restaurant->opening_at);
        $closingTime = new DateTime($restaurant->closed_at);
    
        // Handle cases where closing time is after midnight
        if ($closingTime <= $openingTime) {
            $closingTime->modify('+1 day');
        }
    
        return ($now >= $openingTime && $now <= $closingTime);
    }
    
}
