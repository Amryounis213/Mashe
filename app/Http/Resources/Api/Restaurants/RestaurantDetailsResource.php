<?php

namespace App\Http\Resources\Api\Restaurants;

use App\Http\Resources\Api\Address\AddressResource;
use App\Http\Resources\Api\Restaurants\MenuResource as RestaurantsMenuResource;
use App\Models\ParentCategory;
use App\Models\Restaurant;
use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

class RestaurantDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       
        $menus = ParentCategory::with(['Foods' => function($qu){
            $qu->orderBy('sort_number');
        }])->whereHasMorph(
            'parentable',
            [Restaurant::class],
            function ($query) {
                $query->where('parentable_id', $this->id);
            }
        )->get();

        $banners = [];

        $banners [0] = [
            'id'=> 1 ,
            'title'=> 'get flat 20% off' ,
            'details'=> 'for all customers up to 20 $ for order above 50$' ,
        ];

        $banners [1] = [
            'id'=> 2 ,
            'title'=> 'get free delivery' ,
            'details'=> 'for all customers register until friday' ,
        ];
        
        return [
            'id' => $this->id,
            'name' => $this->name ,           
            'logo' => dynamicStorage('storage/app/public/restaurant').'/'.$this['logo'],
            'cover_photo' => dynamicStorage('storage/app/public/restaurant/cover').'/'.$this['cover_photo'],
            'is_open'=> $this->isOpen($this),
            'banners' => $banners ,
            'menues'=> RestaurantsMenuResource::collection($menus) ,
            
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
