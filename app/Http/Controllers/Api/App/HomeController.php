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

    public function home_page(Request $request)
    {
        //areaId the app developer get it from Detector api 
        $showMarkets = $request->ShowMarkets ?? false ;
        $areaId = $request->areaId ;
       
        //get Near Restaurants
        $longitude = $request->longitude ?? '0.0';
        $latitude = $request->latitude  ?? '0.0';

        $user = auth('api')->user();
        $ads = [];
        //GET DEFAULT ADDRESS 
        // $address = CustomerAddress::where('user_id', $user->id)->where('is_default' , 1)->first();
       
        if ($areaId) {
            // $zone = Zone::whereContains('coordinates', new Point($address->latitude, $address->longitude, POINT_SRID))->get();
            // return $zone;
            $zone = Zone::where('id' , $areaId)->get();
            if (count($zone) == 0) {
                $errors = [];
                array_push($errors, ['code' => 'coordinates', 'message' => translate('messages.service_not_available_in_this_area')]);
                return response()->json([
                    'errors' => $errors
                ], 403);
            }
            $zoneIds = $zone->pluck('id')->toArray();


        }else{
            $zone = Zone::whereContains('coordinates' , new Point($latitude, $longitude, POINT_SRID))->get();
            if (count($zone) == 0) {
                $errors = [];
                array_push($errors, ['code' => 'coordinates', 'message' => translate('messages.service_not_available_in_this_area')]);
                return response()->json([
                    'errors' => $errors
                ], 403);
            }

            $zoneIds = $zone->pluck('id')->toArray();
        }
        
        if($showMarkets)
        {
            $partners = Restaurant::Market()->where('show_in_home_page',  1)->limit(10)->get();
           
        }else{
            $partners = Restaurant::Restaurant()->where('show_in_home_page',  1)->limit(10)->get();
          
        }


       

        $distance = 100; // kilometers
        $nearbyRestaurants = $partners->filter(function ($restaurant) use ($longitude, $latitude, $distance) {
            $restaurantDistance = $this->getDistanceToRestaurant($restaurant, $latitude, $longitude);
            return ($restaurantDistance <= $distance) && ($restaurantDistance != 0);
        })->map(function ($restaurant) use ($latitude, $longitude) {
            // Assuming getDeliveryTime is a method to calculate or retrieve delivery time
            $restaurant->delivery_time = $this->getDeliveryTime($restaurant, $latitude, $longitude);
            return $restaurant;
        });


        $categories = ZoneCategory::ForRestaurants()->whereIn('zone_id', $zoneIds)->where('status' , 1)->limit(10)->get();
        $banners = Banner::where('status' , 1)->get();
        $data = [
            'banners'=> BannersResource::collection($banners) ,
            'categories' => CategoryResource::collection($categories),
            'partners' => RestaurantsResource::collection($nearbyRestaurants),
            'balance' => $user->Wallet?->balance,
        ];

        return $this->SuccessApi($data);
    }

    public function market_home_page(Request $request)
    {
        //areaId the app developer get it from Detector api 
        $showMarkets = $request->ShowMarkets ?? false ;
        $areaId = $request->areaId ;
       
        //get Near Restaurants
        $longitude = $request->longitude ?? '0.0';
        $latitude = $request->latitude  ?? '0.0';

        $user = auth('api')->user();
        $ads = [];
        //GET DEFAULT ADDRESS 
        // $address = CustomerAddress::where('user_id', $user->id)->where('is_default' , 1)->first();
       
        if ($areaId) {
            // $zone = Zone::whereContains('coordinates', new Point($address->latitude, $address->longitude, POINT_SRID))->get();
            // return $zone;
            $zone = Zone::where('id' , $areaId)->get();
            if (count($zone) == 0) {
                $errors = [];
                array_push($errors, ['code' => 'coordinates', 'message' => translate('messages.service_not_available_in_this_area')]);
                return response()->json([
                    'errors' => $errors
                ], 403);
            }
            $zoneIds = $zone->pluck('id')->toArray();


        }else{
            $zone = Zone::whereContains('coordinates' , new Point($latitude, $longitude, POINT_SRID))->get();
            if (count($zone) == 0) {
                $errors = [];
                array_push($errors, ['code' => 'coordinates', 'message' => translate('messages.service_not_available_in_this_area')]);
                return response()->json([
                    'errors' => $errors
                ], 403);
            }

            $zoneIds = $zone->pluck('id')->toArray();
        }
        
        $partners = Restaurant::Market();
        $HomePagePartners = $partners->where('show_in_home_page', 1 )->limit(10)->get();
        $IsFeaturedPartners = $partners->where('is_featured', 1 )->limit(10)->get();

        $distance = 100; // kilometers
        $nearbyRestaurants = $HomePagePartners->filter(function ($restaurant) use ($longitude, $latitude, $distance) {
            $restaurantDistance = $this->getDistanceToRestaurant($restaurant, $latitude, $longitude);
            return ($restaurantDistance <= $distance) && ($restaurantDistance != 0);
        })->map(function ($restaurant) use ($latitude, $longitude) {
            // Assuming getDeliveryTime is a method to calculate or retrieve delivery time
            $restaurant->delivery_time = $this->getDeliveryTime($restaurant, $latitude, $longitude);
            return $restaurant;
        });


        $categories = ZoneCategory::ForMarkets()->whereIn('zone_id', $zoneIds)->where('status' , 1)->limit(10)->get();
        $banners = Banner::where('status' , 1)->get();

        $sections = [
            'sectionOne' => [
                'title' => 'Banners',
                'data' => $banners,
            ],
            'sectionTwo' => [
                'title' => 'Popular Stores',
                'data' => $partners->where('is_featured', 1 )->limit(10)->get(), 
            ],
            'sectionThree' => [
                'title' => 'Categories',
                'data' => $categories ,
            ],
            'sectionFour' => [
                'title' => 'Featured ',
                'data' => $partners->where('is_featured', 1 )->limit(10)->get()
            ],


        ];
        return response()->json($sections);



        $data = [
            'banners'=> BannersResource::collection($banners) ,
            'categories' => CategoryResource::collection($categories),
            'partners' => RestaurantsResource::collection($nearbyRestaurants),
            'balance' => $user->Wallet?->balance,
        ];

        return $this->SuccessApi($data);
    }



    public function show_partner($id)
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
