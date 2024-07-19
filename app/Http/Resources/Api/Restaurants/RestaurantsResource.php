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
        $tags = ['Top Seller' , 'Top Rated' , 'Nearest'];
        
        return [
            'id' => $this->id,
            'name' => $this->name ,           
            'logo' => dynamicStorage('storage/app/public/restaurant').'/'.$this['logo'],
            'cover_photo' => dynamicStorage('storage/app/public/restaurant/cover').'/'.$this['cover_photo'],
            'time'=> round($this->delivery_time), 
            'distance'=> round($this->distance) . ' km' ,
            'rating'=> $this->rating[4] ,
            'is_open'=> $this->isOpen($this) ,
            'tag'=> $this->getTags($tags, $this) ,
            
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


    private function getTags($tags, $restaurant) {
        $resultTags = [];

        foreach ($tags as $tag) {
            if ($tag === 'Top Seller' && $this->isTopSeller($restaurant)) {
                $resultTags[] = $tag;
            }
            if ($tag === 'Top Rated' && $this->isTopRated($restaurant)) {
                $resultTags[] = $tag;
            }
            if ($tag === 'Nearest' && $this->isNearest($restaurant)) {
                $resultTags[] = $tag;
            }
        }

        return $resultTags;
    }



    private function isTopSeller($restaurant) {
        // Implement logic to determine if the restaurant is a top seller
        return $restaurant->sales_count >= 100; // Example condition
    }

    private function isTopRated($restaurant) {
        // Implement logic to determine if the restaurant is top rated
        return $restaurant->rating >= 4.5; // Example condition
    }

    private function isNearest($restaurant) {
        // Implement logic to determine if the restaurant is nearest by delivery time
        return $restaurant->delivery_time <= 30; // Example condition
    }
    
}
