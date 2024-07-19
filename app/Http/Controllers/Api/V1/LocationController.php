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
use App\Http\Resources\Api\Zone\ZoneCollection;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Location\Facades\Location;
use App\Models\Country;
use App\Models\Zone;
use App\Traits\ApiTrait;
use Illuminate\Support\Facades\Storage;


use Geocoder\Query\GeocodeQuery;
use Geocoder\Provider\Nominatim\Nominatim;

use Geocoder\ProviderAggregator;
use Geocoder\StatefulGeocoder;

use Illuminate\Support\Facades\Http;
use InvalidArgumentException;
use MatanYadaev\EloquentSpatial\Objects\Point;

class LocationController extends Controller
{
    use ApiTrait;
    public function get_location(Request $request)
    {
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $longitude = $request->longitude;
        $latitude = $request->latitude;
        if ($longitude == '0.0' && $latitude == '0.0') {

            $ip = $request->current_ip;
            // $ip = '82.212.78.93';
            $response = Http::get('http://ip-api.com/json/' . $ip);
            $country = $response->json();
            $C = Country::whereContains('coordinates', new Point($country['lat'], $country['lon'], POINT_SRID))->first();

            if ($C) {
                $zones = Zone::where('country_id', $C->id)->get();
                $countryCurrecny = $C->currency;
            } else {
                $zones = Zone::whereContains('coordinates', new Point($country['lat'], $country['lon'], POINT_SRID))->get();
                //--------------Set Coin to Profile ----------------//
                if (sizeof($zones) > 0) {
                    $countryCurrecny = $zones[0]->Country->currency ;
                }
            }



            return new ZoneCollection($zones);
        } else {
            $zones = Zone::whereContains('coordinates', new Point($latitude, $longitude, POINT_SRID))->get();
            return new ZoneCollection($zones);
        }
    }
}
