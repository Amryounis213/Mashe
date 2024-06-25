<?php

namespace App\Http\Controllers\Api\App;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Banners\BannersResource;
use App\Http\Resources\Api\Categories\CategoryResource;
use App\Http\Resources\Api\Restaurants\RestaurantDetailsResource;
use App\Http\Resources\Api\Restaurants\RestaurantsResource;
use App\Models\BankAccount;
use App\Models\Banner;
use App\Models\CardAccount;
use App\Models\CustomerAddress;
use App\Models\CustomerWallet;
use App\Models\ParentCategory;
use App\Models\Restaurant;
use App\Models\User;
use App\Models\Zone;
use App\Models\ZoneCategory;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use MatanYadaev\EloquentSpatial\Objects\Point;

class HomeController extends Controller
{
    use ApiTrait;

    public function home_page()
    {
        $user = auth('api')->user();
        $ads = [];
        //GET DEFAULT ADDRESS 
        $address = CustomerAddress::where('user_id', $user->id)->first();
        if (isset($address)) {
            $zone = Zone::whereContains('coordinates', new Point($address->latitude, $address->longitude, POINT_SRID))->get();
            if (count($zone) == 0) {
                $errors = [];
                array_push($errors, ['code' => 'coordinates', 'message' => translate('messages.service_not_available_in_this_area')]);
                return response()->json([
                    'errors' => $errors
                ], 403);
            }

            $zoneIds = $zone->pluck('id')->toArray();
        }

        $restaurants = Restaurant::where('show_in_home_page',  1)->limit(10)->get();
        //get Near Restaurants
        $lng = $address->longitude;
        $lat = $address->latitude;
        $distance = 10; // kilometers
        $nearbyRestaurants = $restaurants->filter(function ($restaurant) use ($lng, $lat, $distance) {
            $restaurantDistance = $this->getDistanceToRestaurant($restaurant, $lat, $lng);
            return ($restaurantDistance <= $distance) && ($restaurantDistance != 0);
        })->map(function ($restaurant) use ($lat, $lng) {
            // Assuming getDeliveryTime is a method to calculate or retrieve delivery time
            $restaurant->delivery_time = $this->getDeliveryTime($restaurant, $lat, $lng);
            return $restaurant;
        });

        $categories = ZoneCategory::whereIn('zone_id', $zoneIds)->where('status' , 1)->get();
        $banners = Banner::where('status' , 1)->get();
        // return $restaurants;
        $data = [
            'banners'=> BannersResource::collection($banners) ,
            'categories' => CategoryResource::collection($categories),
            'restaurants' => RestaurantsResource::collection($nearbyRestaurants),
            'balance' => $user->Wallet?->balance,
        ];

        return $this->SuccessApi($data);
    }

    public function show_restaurant($id)
    {
        $restaurant = Restaurant::where('id', $id)->first();
        return $this->SuccessApi(new RestaurantDetailsResource($restaurant));
    }


    
    function getDistanceToRestaurant($restaurant, $lat2, $lng2){
        $lat1 = deg2rad($restaurant->latitude);
        $lng1 = deg2rad($restaurant->longitude);

        $lat2 = deg2rad($lat2);
        $lng2 = deg2rad($lng2);

        $delta_lat = $lat2 - $lat1;
        $delta_lng = $lng2 - $lng1;

        $hav_lat = (sin($delta_lat / 2))**2;
        $hav_lng = (sin($delta_lng / 2))**2;

        $distance = 2 * asin(sqrt($hav_lat + cos($lat1) * cos($lat2) * $hav_lng));

        $distance = 6371*$distance;
        // dd($distance);
        return $distance ;
        // If you want calculate the distance in miles instead of kilometers, replace 6371 with 3959.
        
        // $response = Http::get('https://maps.googleapis.com/maps/api/distancematrix/json?origins='.$lat1.','.$lng1.'&destinations='.$lat2 .','. $lng2 .'&key=AIzaSyCWAICdTrwdd6hkHnS_vEnrXg3LETWNLoU');
        // $data = $response->json() ;
        // if($data['rows'][0]['elements'][0]['status'] == 'ZERO_RESULTS' || $data['rows'][0]['elements'][0]['status'] == 'NOT_FOUND')
        // {
        //     return 0;
        // }
        // $distance = $data['rows'][0]['elements'][0]['distance']['value'] / 1000;

        // return number_format((float)$distance , 2, '.', '');

    }


    function getDeliveryTime($restaurant, $lat2, $lng2){
        $distance = $this->getDistanceToRestaurant($restaurant, $lat2, $lng2) ;
        $averageSpeed = 30; // in km/h
        return  $distance / $averageSpeed * 60;
    }
}
