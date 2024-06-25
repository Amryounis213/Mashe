<?php

namespace App\Http\Controllers\Api\App;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Address\AddressCollection;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use MatanYadaev\EloquentSpatial\Objects\Point;

class AddressController extends Controller
{
    public function address_list(Request $request)
    {
        $limit = $request['limit']??10;
        $offset = $request['offset']??1;

        $addresses = CustomerAddress::where('user_id', auth('api')->id())->latest()->paginate($limit, ['*'], 'page', $offset);

        
        return new AddressCollection($addresses);
    }

    public function add_new_address(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'contact_person_name' => 'required',
            'address_type' => 'required',
            // 'contact_person_number' => 'required',
            'address' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $zone = Zone::whereContains('coordinates', new Point($request->latitude, $request->longitude, POINT_SRID))->get(['id']);
        if(count($zone) == 0)
        {
            $errors = [];
            array_push($errors, ['code' => 'coordinates', 'message' => translate('messages.service_not_available_in_this_area')]);
            return response()->json([
                'errors' => $errors
            ], 403);
        }

        $address = [
            'user_id' => $request?->user()?->id,
            // 'contact_person_name' => $request->contact_person_name,
            'contact_person_number' => auth('api')->user()->phone ,
            'address_type' => $request->address_type,
            'address' => $request->address,
            // 'floor' => $request->floor,
            // 'road' => $request->road,
            // 'house' => $request->house,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'zone_id' => $zone[0]->id,
            'created_at' => now(),
            'updated_at' => now()
        ];
        DB::table('customer_addresses')->insert($address);
        return response()->json(['message' => translate('messages.successfully_added'),'zone_ids'=>array_column($zone->toArray(), 'id')], 200);
    }
    
    public function update_address(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            // 'contact_person_name' => 'required',
            'address_type' => 'required',
            // 'contact_person_number' => 'required',
            'address' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        $zone = Zone::whereContains('coordinates', new Point($request->latitude, $request->longitude, POINT_SRID))->first();        
        if(!$zone)
        {
            $errors = [];
            array_push($errors, ['code' => 'coordinates', 'message' => translate('messages.service_not_available_in_this_area')]);
            return response()->json([
                'errors' => $errors
            ], 403);
        }
        $address = [
            'user_id' => $request?->user()?->id,
            // 'contact_person_name' => $request->contact_person_name,
            // 'contact_person_number' => $request->contact_person_number,
            'address_type' => $request->address_type,
            'address' => $request->address,
            // 'floor' => $request->floor,
            // 'road' => $request->road,
            // 'house' => $request->house,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'zone_id' => $zone->id,
            'created_at' => now(),
            'updated_at' => now()
        ];
        DB::table('customer_addresses')->where('id',$id)->update($address);
        return response()->json(['message' => translate('messages.updated_successfully'),'zone_id'=>$zone->id], 200);
    }

    public function delete_address(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        if (DB::table('customer_addresses')->where(['id' => $request['address_id'], 'user_id' => $request?->user()?->id])->first()) {
            DB::table('customer_addresses')->where(['id' => $request['address_id'], 'user_id' => $request?->user()?->id])->delete();
            return response()->json(['message' => translate('messages.successfully_removed')], 200);
        }
        return response()->json(['message' => translate('messages.not_found')], 404);
    }

    public function get_order_list(Request $request)
    {
        $orders = Order::with('restaurant')->where('is_guest',0)->where(['user_id' => $request?->user()?->id])->get();
        return response()->json($orders, 200);
    }

    public function get_order_details(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $details = OrderDetail::where(['order_id' => $request['order_id']])->get();
        foreach ($details as $det) {
            $det['product_details'] = json_decode($det['product_details'], true);
        }

        return response()->json($details, 200);
    }

    public function info(Request $request)
    {

        if (!$request->hasHeader('X-localization')) {

            $errors = [];
            array_push($errors, ['code' => 'current_language_key', 'message' => translate('messages.current_language_key_required')]);
            return response()->json([
                'errors' => $errors
            ], 200);
        }


        $current_language = $request->header('X-localization');
        $user = User::findOrFail($request->user()->id);
        $user->current_language_key = $current_language;
        $user->save();


        $data = $request?->user();
        $data['userinfo'] = $data?->userinfo;
        $data['order_count'] =(integer)$request?->user()?->orders()->where('is_guest',0)->count();
        $data['member_since_days'] =(integer)$request?->user()?->created_at?->diffInDays();
        $discount_data= Helpers::getCusromerFirstOrderDiscount(order_count:$data['order_count'] ,user_creation_date:$request->user()->created_at,refby:$request->user()->ref_by);
        $data['is_valid_for_discount'] = data_get($discount_data,'is_valid');
        $data['discount_amount'] = (float) data_get($discount_data,'discount_amount');
        $data['discount_amount_type'] = data_get($discount_data,'discount_amount_type');
        $data['validity'] =(string) data_get($discount_data,'validity');

        unset($data['orders']);
        return response()->json($data, 200);
    }

   
}
