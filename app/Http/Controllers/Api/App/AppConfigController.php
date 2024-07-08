<?php

namespace App\Http\Controllers\Api\App;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\BankResource;
use App\Http\Resources\CountriesResource;
use App\Http\Resources\LangResource;
use App\Models\Bank;
use App\Models\BusinessSetting;
use App\Models\Country;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\Zone;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Point;

class AppConfigController extends Controller
{
    use ApiTrait;
    public function CustomerApp(Request $request)
    {
        $langs = BusinessSetting::where('key', 'system_language')->first();
        $countries = Country::where('status' , 1)->get();
        $banks = Bank::where('status' , 1)->get();

        
        $DATA = [
            'languages' => LangResource::collection(json_decode($langs->value)),
            'countries'=> CountriesResource::collection($countries) ,
            'banks'=> BankResource::collection($banks),
            // 'add_card_frame_url'=> $ifram_url ,
        ];
        return $this->SuccessApi($DATA);

    }



    public function Cities($id = null)
    {
        $countries = Zone::where('country_id' , $id)->get();
        return $this->SuccessApi($countries);
    }




    
}
