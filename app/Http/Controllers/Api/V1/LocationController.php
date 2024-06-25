<?php

namespace App\Http\Controllers\Api\V1;

use Altwaireb\CountriesStatesCities\Models\Country as ModelsCountry;
use App\Models\Food;
use App\Models\Category;
use App\Models\PriorityList;
use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use App\Models\BusinessSetting;
use App\CentralLogics\CategoryLogic;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Location\Facades\Location;
use App\Models\Country;
use Illuminate\Support\Facades\Storage;


use Geocoder\Query\GeocodeQuery;
use Geocoder\Provider\Nominatim\Nominatim;

use Geocoder\ProviderAggregator;
use Geocoder\StatefulGeocoder;

use Illuminate\Support\Facades\Http;
use InvalidArgumentException;

class LocationController extends Controller
{

    public function get_location(Request $request)
    {
        
        $apiKey = 'nohaelmandoh';
        $clientIP = request()->ip();
        $current_ip = $clientIP ;
        $position = Location::get($current_ip);

        // $sa = ModelsCountry::getByIso2($position->countryCode);  

        // return  $position;
        // $countryCode = 'IL'; // Example: United States
        $endpoint = "http://api.geonames.org/searchJSON?country=$position->countryCode&maxRows=10&username=$apiKey";

        $response = Http::get($endpoint);
        $result = [];
        if ($response->successful()) {
            // return  $response;
            $data = $response->json();
            $cities = $response['geonames'];
            // return count($cities) ;
            // Process the cities data
            // return gettype($data['geonames']);
            $geonames = $data['geonames'];
            // Check if the response contains any results
            if (isset($data['geonames'])) {
                for ($i = 0; $i < count($geonames); $i++) {
                    // Access the values from the response
                    $firstResult = $geonames[$i]; // Assuming you want the first result
                    // return  gettype( $firstResult);
                    if (count($firstResult) > 0) {
                        $adminCode1 = $firstResult['adminCode1'] ?? '--';
                        $latitude = $firstResult['lat'];
                        $longitude = $firstResult['lng'];
                        $distance = $this->calculateDistance($latitude,  $longitude, $position->latitude, $position->longitude);
                        $bounds = $this->calculateBounds($latitude,  $longitude, $distance);
                        $countryName = $firstResult['countryName'] ?? '--';
                        $name = $firstResult['name'] ?? '--';
                        $data = [
                            "areaId" => $adminCode1,
                            "coordinates" => $this->generateRandomCoordinates(40, $bounds['minLat'], $bounds['maxLat'], $bounds['minLng'],  $bounds['maxLng']),
                            "latitude" => $latitude,
                            "longitude" =>  $longitude,
                            "countryName" => $countryName,
                            "name" => $name,
                            'distance' => $distance

                        ];
                        array_push($result, $data);
                    }
                }
            } else {
                // No results found
                echo "No results found.";
            }
            //             foreach($cities as $c){
            //                 // return gettype($c);
            //                 $data_json = json_decode($c, true);
            // return  $data_json;
            //                 // $data=[
            //                 //     "areaId"=> $c['adminCode1'],
            //                 //     "coordinates"=> $this->generateRandomCoordinates(40,30,40) ,
            //                 //     "latitude"=> $c['lat'],
            //                 //     "longitude"=>  $c['lng'],    
            //                 // ];
            //                 // array_push($result, $data);

            //             }

            // $cityGeometries = $this->getCityGeometries($countryName);
            // return  $cities;
        } else {
            // Handle API request failure
            $errorMessage = $response->body();
            return  $errorMessage;
        }

        // Instantiate the provider (Nominatim in this case)
        // $provider = new \Nominatim();

        // // Create the provider aggregator
        // $providerAggregator = new \ProviderAggregator();
        // $providerAggregator->registerProvider($provider);

        // // Instantiate the stateful geocoder
        // $geocoder = new \StatefulGeocoder($providerAggregator);


        // $result = $geocoder->geocodeQuery(\GeocodeQuery::create('New York, USA'))->first();

        // if ($result !== null) {
        //     $latitude = $result->getCoordinates()->getLatitude();
        //     $longitude = $result->getCoordinates()->getLongitude();

        //     return ( "Latitude: $latitude, Longitude: $longitude");
        // } else {
        //     return  ("Geocoding failed.");
        // }



        // Country name
        // $countryName = 'Egypt';
        // $current_ip = $request->current_ip;
        // $position = Location::get($current_ip);

        // $sa = ModelsCountry::getByIso2($position->countryCode);
        // $states = $sa->states;
        // return  $states;
        // Make request to a detailed geographic dataset or service to get city geometries
        // $cityGeometries = $this->getCityGeometries($countryName);

        // $response = [];

        // foreach ($cityGeometries as $cityGeometry) {
        //     // Extract city data
        //     $cityId = $cityGeometry['cityId'];
        //     $cityName = $cityGeometry['cityName'];
        //     $coordinates = $cityGeometry['coordinates'];

        //     // Add city data to response
        //     $response[] = [
        //         'cityId' => $cityId,
        //         'cityName' => $cityName,
        //         'coordinates' => $coordinates
        //     ];
        // }

        return response()->json(['allAreas' => $result]);
    }

    // Function to retrieve city geometries from a detailed geographic dataset or service
    // private function getCityGeometries($countryName)
    // {
    //     // Mock data for demonstration (replace with actual data retrieval)
    //     $cityGeometries = [
    //         [
    //             'cityId' => 1,
    //             'cityName' => 'Cairo',
    //             'coordinates' => $this->generateRandomCoordinates(40) // 40 coordinates for Cairo
    //         ],
    //         [
    //             'cityId' => 2,
    //             'cityName' => 'Alexandria',
    //             'coordinates' => $this->generateRandomCoordinates(40) // 40 coordinates for Alexandria
    //         ],
    //         // More cities...
    //     ];

    //     return $cityGeometries;
    // }


    function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        // Convert latitude and longitude from degrees to radians
        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);

        // Earth radius in kilometers
        $earthRadius = 6371;

        // Calculate differences in latitude and longitude
        $deltaLat = $lat2 - $lat1;
        $deltaLon = $lon2 - $lon1;

        // Haversine formula
        $a = sin($deltaLat / 2) * sin($deltaLat / 2) +
            cos($lat1) * cos($lat2) * sin($deltaLon / 2) * sin($deltaLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;

        return $distance;
    }

    function calculateBounds($originalLat, $originalLng, $distance)
    {
        // Earth's radius in kilometers
        $earthRadius = 6371;

        // Convert distance from kilometers to radians
        $angularDistance = $distance / $earthRadius;

        // Convert original latitude and longitude from degrees to radians
        $originalLatRad = deg2rad($originalLat);
        $originalLngRad = deg2rad($originalLng);

        // Calculate minimum and maximum latitude
        $minLat = rad2deg($originalLatRad - $angularDistance);
        $maxLat = rad2deg($originalLatRad + $angularDistance);

        // Calculate minimum and maximum longitude
        $deltaLng = asin(sin($angularDistance) / cos($originalLatRad));
        $minLng = rad2deg($originalLngRad - $deltaLng);
        $maxLng = rad2deg($originalLngRad + $deltaLng);

        return [
            'minLat' => $minLat,
            'maxLat' => $maxLat,
            'minLng' => $minLng,
            'maxLng' => $maxLng,
        ];
    }
    // Function to generate random coordinates for a city
    private function generateRandomCoordinates($numberOfCoordinates, $minLat, $maxLat, $minLng, $maxLng)
    {

        if ($maxLat <= $minLat || $maxLng <= $minLng) {
            throw new InvalidArgumentException("Max values must be greater than min values.");
        }


        // $randomLat = mt_rand($minLat * 1000000, $maxLat * 1000000) / 1000000;
        // $randomLng = mt_rand($minLng * 1000000, $maxLng * 1000000) / 1000000;

        // $randomLat = $minLat + mt_rand() / mt_getrandmax() * ($maxLat - $minLat);
        // $randomLng = $minLng + mt_rand() / mt_getrandmax() * ($maxLng - $minLng);

        $coordinates = [];

        // Generate random latitude and longitude for each coordinate
        for ($i = 0; $i < $numberOfCoordinates; $i++) {
            $randomLat = $minLat + mt_rand() / mt_getrandmax() * ($maxLat - $minLat);
            $randomLng = $minLng + mt_rand() / mt_getrandmax() * ($maxLng - $minLng);

            $coordinates[] = [
                'latitude' => $randomLat, // Random latitude between 29 and 31
                'longitude' => $randomLng // Random longitude between 29 and 31
            ];
        }

        return $coordinates;
    }

    public function _get_location(Request $request)
    {
        $current_ip = $request->current_ip;
        $position = Location::get($current_ip);

        $countryCode = $position->countryCode;
        $countryName = strtolower($position->countryName);

        // $cityName = $request->cityName;
        $path = storage_path() . "/app/geo/" . $countryName . ".geojson"; // ie: /var/www/laravel/app/storage/json/filename.json
        // $path = storage_path() . "/app/geo/cities.geojson";
        $json = json_decode(file_get_contents($path), true);
        $paths = [];
        // return $json ;
        // foreach ($json['features'] as $feature) {
        //     // return $feature;
        //     $str = $feature['properties']['NAME'];
        // return gettype($str);
        //    if (str_contains($str, $cityName)) return 'hi'; else return 'bai';
        // return (str_contains($feature['properties']['NAME'], $cityName));
        // if (str_contains($str, $cityName)) {
        // if(strpos($str, $cityName) != false){
        // if (stripos($str, $cityName) !== false) {///////////////////work
        // if ($feature['properties']['NAME'] == $cityName) {
        // return $str;
        $coordinates = $json['geometry']['coordinates'][0];


        foreach ($coordinates as $coordinate) {
            array_push($paths, [
                'latitude' => $coordinate[1],
                'longitude' => $coordinate[0]
            ]);
        }
        // }
        // }
        $areas = [

            "countryName" => $position->countryName,
            "countryCode" => $position->countryCode,

            "coordinates" => $paths,
            // "isNew" => false,
            // "isReadyArea" => false,
            // "isMarketReady" => false,
            // "isRestaurantReady" => false
        ];
        $data = [
            // "isNew"=> true,
            // "showAccessibilityStatement"=> true,
            "areasContainer" => $areas
            // "latitude": 31.39022,
            // "longitude": 34.7565186,
            // "distance": 5059928.75531495,
            // "name": "Rahat",
            // "countryId": 1,

        ];

        return response()->json($data, 200);
        // $contents = Storage::json('custom.geo.json');
        // $gravatar = json_decode($contents);

        // $json = json_decode( $contents);  


        // return($request->current_ip);
        $current_ip = $request->current_ip;
        $position = Location::get($current_ip);

        $sa = ModelsCountry::getByIso2($position->countryCode);
        $states_all = [];
        $states = $sa->states;
        // $states = Country::where('name',   $position->countryName)->first()->states; \
        foreach ($states as $state) {
            array_push($states_all, [
                "id" => $state->id,

                "name" => $state->name,
                "latitude" =>  $state->latitude,
                "longitude" =>  $state->longitude,
            ]);
        }

        $all_states = [
            // 'country_details'=>$sa,
            'areasContainer' => [
                'allAreas' => $states_all,
            ]
        ];

        return response()->json($all_states, 200);
    }
}
