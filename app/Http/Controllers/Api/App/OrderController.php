<?php

namespace App\Http\Controllers\Api\App;

use App\Models\Cart;
use App\Models\Food;
use App\Models\User;
use App\Models\Zone;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Refund;
use App\Models\Review;
use App\Mail\PlaceOrder;
use App\Models\DMReview;
use App\Models\Restaurant;
use App\Mail\RefundRequest;
use App\Models\DeliveryMan;
use App\Models\OrderDetail;
use App\Models\ItemCampaign;
use App\Models\RefundReason;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use App\Models\BusinessSetting;
use App\Models\CashBackHistory;
use App\Models\OfflinePayments;
use App\CentralLogics\OrderLogic;
use App\Models\OrderCancelReason;
use App\CentralLogics\CouponLogic;
use Illuminate\Support\Facades\DB;
use App\Mail\OrderVerificationMail;
use App\CentralLogics\CustomerLogic;
use App\Http\Controllers\Controller;
use App\Models\CustomerAddress;
use App\Models\OfflinePaymentMethod;
use App\Models\OrderItem;
use App\Models\SubscriptionSchedule;
use App\Models\VariationOption;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use MatanYadaev\EloquentSpatial\Objects\Point;

class OrderController extends Controller
{
    public function track_order(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'guest_id' => $request->user ? 'nullable' : 'required',
            'contact_number' => $request->user ? 'nullable' : 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        $user_id = $request->user ? $request->user->id : $request['guest_id'];

        $order = Order::with(['restaurant', 'restaurant.restaurant_sub', 'refund', 'delivery_man', 'delivery_man.rating', 'subscription', 'payments'])->withCount('details')->where(['id' => $request['order_id'], 'user_id' => $user_id])
            ->when(!$request->user, function ($query) use ($request) {
                return $query->whereJsonContains('delivery_address->contact_person_number', $request['contact_number']);
            })
            ->Notpos()->first();

        if ($order) {
            $order['restaurant'] = $order['restaurant'] ? Helpers::restaurant_data_formatting($order['restaurant']) : $order['restaurant'];
            $order['delivery_address'] = $order['delivery_address'] ? json_decode($order['delivery_address'], true) : $order['delivery_address'];
            $order['delivery_man'] = $order['delivery_man'] ? Helpers::deliverymen_data_formatting([$order['delivery_man']]) : $order['delivery_man'];
            $order['offline_payment'] =  isset($order->offline_payments) ? Helpers::offline_payment_formater($order->offline_payments) : null;
            $order['is_reviewed'] =   $order->details_count >  Review::whereOrderId($request->order_id)->count() ? False : True;
            $order['is_dm_reviewed'] =  $order?->delivery_man ? DMReview::whereOrderId($order->id)->exists()  : True;

            if ($order->subscription) {
                $order->subscription['delivered_count'] = (int) $order->subscription->logs()->whereOrderStatus('delivered')->count();
                $order->subscription['canceled_count'] = (int) $order->subscription->logs()->whereOrderStatus('canceled')->count();
            }

            unset($order['offline_payments']);
            unset($order['details']);
        } else {
            return response()->json([
                'errors' => [
                    ['code' => 'order_not_found', 'message' => translate('messages.Order_not_found')]
                ]
            ], 404);
        }
        return response()->json($order, 200);
    }

    public function place_order(Request $request)
    {
        $user = auth('api')->user();
        $validator = Validator::make($request->all(), [
            'order_amount' => 'required',
            'payment_method' => 'required|in:cash_on_delivery,digital_payment,wallet',
            'card_id' => 'required_if:payment_method,digital_payment',
            'order_type' => 'required|in:pick_up,delivery',
            'restaurant_id' => 'required',
            // 'distance' => 'required_if:order_type,delivery',
            'address' => 'required_if:order_type,delivery',
            // 'longitude' => 'required_if:order_type,delivery',
            // 'latitude' => 'required_if:order_type,delivery',
            'dm_tips' => 'nullable|numeric',
            'guest_id' =>   $user ? 'nullable' : 'required',
            'contact_person_name' =>   $user ? 'nullable' : 'required',
            'contact_person_number' =>   $user ? 'nullable' : 'required',
        ]);
        $foods = Food::whereIn('id' ,$request->items)->get();
       
        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        if ($request->payment_method == 'wallet' && Helpers::get_business_settings('wallet_status', false) != 1) {
            return response()->json([
                'errors' => [
                    ['code' => 'payment_method', 'message' => translate('messages.customer_wallet_disable_warning')]
                ]
            ], 203);
        }




        $digital_payment = Helpers::get_business_settings('digital_payment');
        if ($digital_payment['status'] == 0 && $request->payment_method == 'digital_payment') {
            return response()->json([
                'errors' => [
                    ['code' => 'digital_payment', 'message' => translate('messages.digital_payment_for_the_order_not_available_at_this_time')]
                ]
            ], 403);
        }


        $coupon = null;
        $delivery_charge = null;
        $free_delivery_by = null;
        $coupon_created_by = null;
        $schedule_at = $request->schedule_at ? \Carbon\Carbon::parse($request->schedule_at) : now();
        $per_km_shipping_charge = 0;
        $minimum_shipping_charge = 0;
        $maximum_shipping_charge =  0;
        $max_cod_order_amount_value =  0;
        $increased = 0;
        $distance_data = $request->distance ?? 0;


        $home_delivery = BusinessSetting::where('key', 'home_delivery')->first()?->value ?? null;
        if ($home_delivery == null && $request->order_type == 'delivery') {
            return response()->json([
                'errors' => [
                    ['code' => 'order_type', 'message' => translate('messages.Home_delivery_is_disabled')]
                ]
            ], 403);
        }

        $pick_up = BusinessSetting::where('key', 'pick_up')->first()?->value ?? null;
        if ($pick_up == null && $request->order_type == 'pick_up') {
            return response()->json([
                'errors' => [
                    ['code' => 'order_type', 'message' => translate('messages.pick_up_is_disabled')]
                ]
            ], 403);
        }

        $settings =  BusinessSetting::where('key', 'cash_on_delivery')->first();
        $cod = json_decode($settings?->value, true);
        if (isset($cod['status']) &&  $cod['status'] != 1 && $request->payment_method == 'cash_on_delivery') {
            return response()->json([
                'errors' => [
                    ['code' => 'order_time', 'message' => translate('messages.Cash_on_delivery_is_not_active')]
                ]
            ], 403);
        }

        if ($request->schedule_at && $schedule_at < now()) {
            return response()->json([
                'errors' => [
                    ['code' => 'order_time', 'message' => translate('messages.you_can_not_schedule_a_order_in_past')]
                ]
            ], 406);
        }
        $restaurant = Restaurant::with(['discount', 'restaurant_sub'])->selectRaw('*, IF(((select count(*) from `restaurant_schedule` where `restaurants`.`id` = `restaurant_schedule`.`restaurant_id` and `restaurant_schedule`.`day` = ' . $schedule_at->format('w') . ' and `restaurant_schedule`.`opening_time` < "' . $schedule_at->format('H:i:s') . '" and `restaurant_schedule`.`closing_time` >"' . $schedule_at->format('H:i:s') . '") > 0), true, false) as open')->where('id', $request->restaurant_id)->first();
        // return $restaurant;
        if (!$restaurant) {
            return response()->json([
                'errors' => [
                    ['code' => 'order_time', 'message' => translate('messages.restaurant_not_found')]
                ]
            ], 404);
        }



        // if($request->schedule_at && !$restaurant->schedule_order){
        //     return response()->json([
        //         'errors' => [
        //             ['code' => 'schedule_at', 'message' => translate('messages.schedule_order_not_available')]
        //         ]
        //     ], 406);
        // }

        // if($restaurant->open == false && !$request->subscription_order){
        //     return response()->json([
        //         'errors' => [
        //             ['code' => 'order_time', 'message' => translate('messages.restaurant_is_closed_at_order_time')]
        //         ]
        //     ], 406);
        // }

        // $instant_order = BusinessSetting::where('key', 'instant_order')->first()?->value;
        // if(($instant_order != 1 || $restaurant->restaurant_config?->instant_order != 1) && !$request->schedule_at && !$request->subscription_order){
        //     return response()->json([
        //         'errors' => [
        //             ['code' => 'instant_order', 'message' => translate('messages.instant_order_is_not_available_for_now!')]
        //         ]
        //     ], 403);
        // }

        // DB::beginTransaction();

        $data = Helpers::vehicle_extra_charge(distance_data: $distance_data);
        $extra_charges = (float) (isset($data) ? $data['extra_charge']  : 0);
        // return $extra_charges ;
        $vehicle_id = (isset($data) ? (int) $data['vehicle_id']  : null);

        // if($request->latitude && $request->longitude){
        //     $zone = Zone::where('id', $restaurant->zone_id)->whereContains('coordinates', new Point($request->latitude, $request->longitude, POINT_SRID))->first();            if(!$zone)
        //     {
        //         $errors = [];
        //         array_push($errors, ['code' => 'coordinates', 'message' => translate('messages.out_of_coverage')]);
        //         return response()->json([
        //             'errors' => $errors
        //         ], 403);
        //     }
        //     if( $zone->per_km_shipping_charge && $zone->minimum_shipping_charge ) {
        //         $per_km_shipping_charge = $zone->per_km_shipping_charge;
        //         $minimum_shipping_charge = $zone->minimum_shipping_charge;
        //         $maximum_shipping_charge = $zone->maximum_shipping_charge;
        //         $max_cod_order_amount_value= $zone->max_cod_order_amount;
        //         if($zone->increased_delivery_fee_status == 1){
        //             $increased=$zone->increased_delivery_fee ?? 0;
        //         }
        //     }
        // }


        // if($request['order_type'] != 'pick_up' && !$restaurant->free_delivery &&  !isset($delivery_charge) && ($restaurant->restaurant_model == 'subscription' && isset($restaurant->restaurant_sub) && $restaurant->restaurant_sub->self_delivery == 1  || $restaurant->restaurant_model == 'commission' &&  $restaurant->self_delivery_system == 1 )){
        //         $per_km_shipping_charge = $restaurant->per_km_shipping_charge;
        //         $minimum_shipping_charge = $restaurant->minimum_shipping_charge;
        //         $maximum_shipping_charge = $restaurant->maximum_shipping_charge;
        //         $extra_charges= 0;
        //         $vehicle_id=null;
        //         $increased=0;
        // }

        // if($restaurant->free_delivery || $free_delivery_by == 'vendor' ){
        //     $per_km_shipping_charge = $restaurant->per_km_shipping_charge;
        //     $minimum_shipping_charge = $restaurant->minimum_shipping_charge;
        //     $maximum_shipping_charge = $restaurant->maximum_shipping_charge;
        //     $extra_charges= 0;
        //     $vehicle_id=null;
        //     $increased=0;
        // }

        // $original_delivery_charge = ($request->distance * $per_km_shipping_charge > $minimum_shipping_charge) ? $request->distance * $per_km_shipping_charge + $extra_charges  : $minimum_shipping_charge + $extra_charges;

        // if($request['order_type'] == 'pick_up')
        // {
        //     $per_km_shipping_charge = 0;
        //     $minimum_shipping_charge = 0;
        //     $maximum_shipping_charge = 0;
        //     $extra_charges= 0;
        //     $distance_data = 0;
        //     $vehicle_id=null;
        //     $increased=0;
        //     $original_delivery_charge =0;
        // }

        // if ( $maximum_shipping_charge  > $minimum_shipping_charge  && $original_delivery_charge >  $maximum_shipping_charge ){
        //     $original_delivery_charge = $maximum_shipping_charge;
        // }
        // else{
        //     $original_delivery_charge = $original_delivery_charge;
        // }

        // if(!isset($delivery_charge)){
        //     $delivery_charge = ($request->distance * $per_km_shipping_charge > $minimum_shipping_charge) ? $request->distance * $per_km_shipping_charge : $minimum_shipping_charge;
        //     if ( $maximum_shipping_charge  > $minimum_shipping_charge  && $delivery_charge + $extra_charges >  $maximum_shipping_charge ){
        //         $delivery_charge =$maximum_shipping_charge;
        //     }
        //     else{
        //         $delivery_charge =$extra_charges + $delivery_charge;
        //     }
        // }


        // if($increased > 0 ){
        //     if($delivery_charge > 0){
        //         $increased_fee = ($delivery_charge * $increased) / 100;
        //         $delivery_charge = $delivery_charge + $increased_fee;
        //     }
        //     if($original_delivery_charge > 0){
        //         $increased_fee = ($original_delivery_charge * $increased) / 100;
        //         $original_delivery_charge = $original_delivery_charge + $increased_fee;
        //     }
        // }
        $Defaddress = CustomerAddress::where('id' , $request->address)->first();

        $address = [
            'contact_person_name' => $Defaddress->contact_person_name ? $Defaddress->contact_person_name : ($user?$user->f_name . ' ' . $user->f_name:''),
            'contact_person_number' => $Defaddress->contact_person_number ? ($user ? $request->contact_person_number :str_replace('+', '', $request->contact_person_number)) : ($user?$request->user->phone:''),
            'contact_person_email' => $Defaddress->contact_person_email ? $request->contact_person_email : ($request->user?$request->user->email:''),
            'address_type' => $Defaddress->address_type ? $request->address_type:'Delivery',
            'address' => $Defaddress->address,
            'floor' => $Defaddress->floor,
            'road' => $Defaddress->road,
            'house' => $Defaddress->house,
            'longitude' => (string)$Defaddress->longitude,
            'latitude' => (string)$Defaddress->latitude,
        ];

        $total_addon_price = 0;
        $product_price = 0;
        $restaurant_discount_amount = 0;

        $order_details = [];
        $order = new Order();
        // $order->id = 100000 + Order::count() + 1;
        // if (Order::find($order->id)) {
        //     $order->id = Order::orderBy('id', 'desc')->first()->id + 1;
        // }


        $order_status = 'pending';
        // if($request->payment_method == 'wallet' ){
        //     $order_status ='confirmed';
        // }


        $order->distance = $distance_data;
        $order->user_id = auth('api')->id();
        $order->order_amount = $request['order_amount'];
        $order->payment_status =  'paid';
        $order->order_status = $order_status;
        $order->coupon_code = $request['coupon_code'];
        $order->payment_method = $request->payment_method;
        $order->transaction_reference = null;
        $order->order_note = $request['order_note'];
        $order->order_type = $request['order_type'];
        $order->restaurant_id = $request['restaurant_id'];
        $order->restaurant_discount_amount = $restaurant_discount_amount;
        // $order->delivery_charge = round($delivery_charge, config('round_up_to_digit'))??0;
        // $order->original_delivery_charge = round($original_delivery_charge, config('round_up_to_digit'));
        $order->delivery_address = json_encode($address);
        // $order->schedule_at = $schedule_at;
        // $order->scheduled = $request->schedule_at?1:0;     
        // $order->zone_id = $restaurant->zone_id;
        $dm_tips_manage_status = BusinessSetting::where('key', 'dm_tips_status')->first()->value;
        if ($dm_tips_manage_status == 1) {
            $order->dm_tips = $request->dm_tips ?? 0;
        } else {
            $order->dm_tips = 0;
        }
        // $order->vehicle_id = $vehicle_id;
        $order->pending = now();

        // if ($order_status == 'confirmed') {
        //     $order->confirmed = now();
        // }

        $order->created_at = now();
        $order->updated_at = now();

        // $order->cutlery = $request->cutlery ? 1 : 0;
        // $order->unavailable_item_note = $request->unavailable_item_note ?? null ;
        $order->delivery_instruction = $request->delivery_instruction ?? null ;
        // $order->food_instruction = $request->food_instruction ?? null ;
        $order->tax_percentage = $restaurant->tax;



        // $total_price = $product_price + $total_addon_price - $restaurant_discount_amount ;
        $total_price = $request['order_amount'];
        $order->save();



        foreach ($order_details as $key => $item) {
            $order_details[$key]['order_id'] = $order->id;

            if($restaurant_discount_amount <= 0 ){
                $order_details[$key]['discount_on_food'] = 0;
            }
        }
        // OrderDetail::insert($order_details);

        foreach($foods as $key => $item)
        {
            $order_item = OrderItem::create([
                'order_id' => Order::find($order->id)->id,
                'item_id' => $item->id,
                'type' => get_class($item) ,
                'price' => $item->price,
                'quantity' => $request->items[$key]['quantity'],
                'discount' =>0,
                
                'total' => $item->price *  $request->items[$key]['quantity'],
                'action_type' => 1,
                'notes' => $item->notes,
            ]);

        }


        //     DB::commit();
        //     //PlaceOrderMail
        //     $order_mail_status = Helpers::get_mail_status('place_order_mail_status_user');
        //     $order_verification_mail_status = Helpers::get_mail_status('order_verification_mail_status_user');
        //     try {
        //         if($request->payment_method != 'digital_payment' && config('mail.status')){
        //             if ($order->order_status == 'pending' && $order_mail_status == '1'&& $request->user) {
        //                 Mail::to($request->user->email)->send(new PlaceOrder($order->id));
        //             }
        //             if ($order->order_status == 'pending' && config('order_delivery_verification') == 1 && $order_verification_mail_status == '1'&& $request->user) {
        //                 Mail::to($request->user->email)->send(new OrderVerificationMail($order->otp,$request->user->f_name));
        //             }

        //             if ($order->is_guest == 1 && $order->order_status == 'pending' && $order_mail_status == '1' && isset($request->contact_person_email)) {
        //                 Mail::to($request->contact_person_email)->send(new PlaceOrder($order->id));
        //             }
        //             if ($order->is_guest == 1 && $order->order_status == 'pending' && config('order_delivery_verification') == 1 && $order_verification_mail_status == '1' && isset($request->contact_person_email)) {
        //                 Mail::to($request->contact_person_email)->send(new OrderVerificationMail($order->otp,$request->contact_person_name));
        //             }
        //         }


        //     }catch (\Exception $ex) {
        //         info($ex);
        //     }
        return response()->json([
            'message' => translate('messages.order_placed_successfully'),
            'order_id' => $order->id,
            'total_ammount' => $total_price
        ], 200);


        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     info($e->getMessage());
        //     return response()->json([$e->getMessage()], 403);
        // }

        // return response()->json([
        //     'errors' => [
        //         ['code' => 'order_time', 'message' => translate('messages.failed_to_place_order')]
        //     ]
        // ], 403);
    }

    public function get_order_list(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required',
            'offset' => 'required',
            'guest_id' => $request->user ? 'nullable' : 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        $user_id = $request->user ? $request->user->id : $request['guest_id'];

        $paginator = Order::with(['restaurant', 'delivery_man.rating'])->withCount('details')->where(['user_id' => $user_id])->whereIn('order_status', ['delivered', 'canceled', 'refund_requested', 'refund_request_canceled', 'refunded', 'failed'])->Notpos()
            ->whereNull('subscription_id')
            ->when(!isset($request->user), function ($query) {
                $query->where('is_guest', 1);
            })

            ->when(isset($request->user), function ($query) {
                $query->where('is_guest', 0);
            })

            ->latest()->paginate($request['limit'], ['*'], 'page', $request['offset']);
        $orders = array_map(function ($data) {
            $data['delivery_address'] = $data['delivery_address'] ? json_decode($data['delivery_address']) : $data['delivery_address'];
            $data['restaurant'] = $data['restaurant'] ? Helpers::restaurant_data_formatting($data['restaurant']) : $data['restaurant'];
            $data['delivery_man'] = $data['delivery_man'] ? Helpers::deliverymen_data_formatting([$data['delivery_man']]) : $data['delivery_man'];
            $data['is_reviewed'] =   $data['details_count'] >  Review::whereOrderId($data->id)->count() ? False : True;
            $data['is_dm_reviewed'] = $data['delivery_man'] ? DMReview::whereOrderId($data->id)->exists()  : True;
            return $data;
        }, $paginator->items());
        $data = [
            'total_size' => $paginator->total(),
            'limit' => $request['limit'],
            'offset' => $request['offset'],
            'orders' => $orders
        ];
        return response()->json($data, 200);
    }
    public function get_order_subscription_list(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required',
            'offset' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        $user_id = $request->user ? $request->user->id : $request['guest_id'];
        $paginator = Order::with(['restaurant', 'delivery_man.rating'])->withCount('details')->where(['user_id' => $user_id])
            ->Notpos()
            ->whereNotNull('subscription_id')
            ->when(!isset($request->user), function ($query) {
                $query->where('is_guest', 1);
            })

            ->when(isset($request->user), function ($query) {
                $query->where('is_guest', 0);
            })
            ->latest()->paginate($request['limit'], ['*'], 'page', $request['offset']);
        $orders = array_map(function ($data) {
            $data['delivery_address'] = $data['delivery_address'] ? json_decode($data['delivery_address']) : $data['delivery_address'];
            $data['restaurant'] = $data['restaurant'] ? Helpers::restaurant_data_formatting($data['restaurant']) : $data['restaurant'];
            $data['delivery_man'] = $data['delivery_man'] ? Helpers::deliverymen_data_formatting([$data['delivery_man']]) : $data['delivery_man'];
            $data['is_reviewed'] =   $data['details_count'] >  Review::whereOrderId($data->id)->count() ? False : True;
            $data['is_dm_reviewed'] =  $data['delivery_man'] ? DMReview::whereOrderId($data->id)->exists()  : True;

            return $data;
        }, $paginator->items());
        $data = [
            'total_size' => $paginator->total(),
            'limit' => $request['limit'],
            'offset' => $request['offset'],
            'orders' => $orders
        ];
        return response()->json($data, 200);
    }


    public function get_running_orders(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required',
            'offset' => 'required',
            'guest_id' => $request->user ? 'nullable' : 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        $user_id = $request->user ? $request->user->id : $request['guest_id'];

        $paginator = Order::with(['restaurant', 'delivery_man.rating'])->withCount('details')->where(['user_id' => $user_id])
            ->whereNull('subscription_id')
            ->whereNotIn('order_status', ['delivered', 'canceled', 'refund_requested', 'refund_request_canceled', 'refunded', 'failed'])
            ->when(!isset($request->user), function ($query) {
                $query->where('is_guest', 1);
            })

            ->when(isset($request->user), function ($query) {
                $query->where('is_guest', 0);
            })
            ->Notpos()->latest()->paginate($request['limit'], ['*'], 'page', $request['offset']);

        $orders = array_map(function ($data) {
            $data['delivery_address'] = $data['delivery_address'] ? json_decode($data['delivery_address']) : $data['delivery_address'];
            $data['restaurant'] = $data['restaurant'] ? Helpers::restaurant_data_formatting($data['restaurant']) : $data['restaurant'];
            $data['delivery_man'] = $data['delivery_man'] ? Helpers::deliverymen_data_formatting([$data['delivery_man']]) : $data['delivery_man'];
            return $data;
        }, $paginator->items());
        $data = [
            'total_size' => $paginator->total(),
            'limit' => $request['limit'],
            'offset' => $request['offset'],
            'orders' => $orders
        ];
        return response()->json($data, 200);
    }

    public function get_order_details(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'guest_id' => $request->user ? 'nullable' : 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        $user_id = $request->user ? $request->user->id : $request['guest_id'];
        $order = Order::with('details', 'offline_payments', 'subscription.schedules')->where('user_id', $user_id)

            ->when(!isset($request->user), function ($query) {
                $query->where('is_guest', 1);
            })

            ->when(isset($request->user), function ($query) {
                $query->where('is_guest', 0);
            })
            ->find($request->order_id);
        $details = $order?->details;

        if ($details != null && $details->count() > 0) {
            $storage = [];
            foreach ($details as $item) {
                $item['add_ons'] = json_decode($item['add_ons']);
                $item['variation'] = json_decode($item['variation']);
                $item['food_details'] = json_decode($item['food_details'], true);
                $item['zone_id'] = (int) (isset($order->zone_id) ? $order->zone_id :  $order->restaurant->zone_id);
                array_push($storage, $item);
            }
            $data = $storage;
            $subscription_schedules =  $order?->subscription?->schedules;
            $offline_payment = isset($order->offline_payments) ? Helpers::offline_payment_formater($order->offline_payments) : null;

            return response()->json([
                'details' => $data, 'subscription_schedules' => $subscription_schedules, 'offline_payment' => $offline_payment
            ], 200);
        } else {
            return response()->json([
                'errors' => [
                    ['code' => 'order', 'message' => translate('messages.not_found')]
                ]
            ], 200);
        }
    }

    public function cancel_order(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reason' => 'required|max:255',
            'guest_id' => $request->user ? 'nullable' : 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        $user_id = $request->user ? $request->user->id : $request['guest_id'];
        $order = Order::where(['user_id' => $user_id, 'id' => $request['order_id']])

            ->when(!isset($request->user), function ($query) {
                $query->where('is_guest', 1);
            })

            ->when(isset($request->user), function ($query) {
                $query->where('is_guest', 0);
            })
            ->with('details')
            ->Notpos()->first();
        if (!$order) {
            return response()->json([
                'errors' => [
                    ['code' => 'order', 'message' => translate('messages.not_found')]
                ]
            ], 404);
        } else if ($order->order_status == 'pending' || $order->order_status == 'failed' || $order->order_status == 'canceled') {
            $order->order_status = 'canceled';
            $order->canceled = now();
            $order->cancellation_reason = $request->reason;
            $order->canceled_by = 'customer';
            $order->save();

            Helpers::decreaseSellCount(order_details: $order->details);
            Helpers::send_order_notification($order);
            Helpers::increment_order_count($order->restaurant); //for subscription package order increase


            $wallet_status = BusinessSetting::where('key', 'wallet_status')->first()?->value;
            $refund_to_wallet = BusinessSetting::where('key', 'wallet_add_refund')->first()?->value;

            if ($order?->payments && $order?->is_guest == 0) {
                $refund_amount = $order->payments()->where('payment_status', 'paid')->sum('amount');
                if ($wallet_status &&  $refund_to_wallet && $refund_amount > 0) {
                    CustomerLogic::create_wallet_transaction(user_id: $order->user_id, amount: $refund_amount, transaction_type: 'order_refund', referance: $order->id);

                    return response()->json(['message' => translate('messages.order_canceled_successfully_and_refunded_to_wallet')], 200);
                } else {
                    return response()->json(['message' => translate('messages.order_canceled_successfully_and_for_refund_amount_contact_admin')], 200);
                }
            }


            return response()->json(['message' => translate('messages.order_canceled_successfully')], 200);
        }
        return response()->json([
            'errors' => [
                ['code' => 'order', 'message' => translate('messages.you_can_not_cancel_after_confirm')]
            ]
        ], 403);
    }

    public function refund_reasons()
    {
        $refund_reasons = RefundReason::where('status', 1)->get();
        return response()->json([
            'refund_reasons' => $refund_reasons
        ], 200);
    }

    public function refund_request(Request $request)
    {
        if (BusinessSetting::where(['key' => 'refund_active_status'])->first()->value == false) {
            return response()->json([
                'errors' => [
                    ['code' => 'order', 'message' => translate('You can not request for a refund')]
                ]
            ], 403);
        }
        $validator = Validator::make($request->all(), [
            'customer_reason' => 'required|string|max:254',
            'refund_method' => 'nullable|string|max:100',
            'customer_note' => 'nullable|string|max:65535',
            'image.*' => 'nullable|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        $user_id = $request->user ? $request->user->id : $request['guest_id'];
        $order = Order::where(['user_id' => $user_id, 'id' => $request['order_id']])


            ->when(!isset($request->user), function ($query) {
                $query->where('is_guest', 1);
            })

            ->when(isset($request->user), function ($query) {
                $query->where('is_guest', 0);
            })
            ->Notpos()->first();
        if (!$order) {
            return response()->json([
                'errors' => [
                    ['code' => 'order', 'message' => translate('messages.not_found')]
                ]
            ], 404);
        } else if ($order->order_status == 'delivered' && $order->payment_status == 'paid') {

            $id_img_names = [];
            if ($request->has('image')) {
                foreach ($request->file('image') as $img) {
                    $image_name = Helpers::upload(dir: 'refund/', format: 'png', image: $img);
                    array_push($id_img_names, $image_name);
                }
                $images = json_encode($id_img_names);
            } else {
                $images = json_encode([]);
                // return response()->json(['message' => 'no_image'], 200);
            }

            $refund_amount = round($order->order_amount - $order->delivery_charge - $order->dm_tips, config('round_up_to_digit'));

            $refund = new Refund();
            $refund->order_id = $order->id;
            $refund->user_id = $order->user_id;
            $refund->order_status = $order->order_status;
            $refund->refund_status = 'pending';
            $refund->refund_method = $request->refund_method ?? 'wallet';
            $refund->customer_reason = $request->customer_reason;
            $refund->customer_note = $request->customer_note;
            $refund->refund_amount = $refund_amount;
            $refund->image = $images;
            $refund->save();

            $order->order_status = 'refund_requested';
            $order->refund_requested = now();
            $order->save();
            // Helpers::send_order_notification($order);

            $admin = Admin::where('role_id', 1)->first();
            try {
                if (config('mail.status') && $admin['email'] && Helpers::get_mail_status('refund_request_mail_status_admin') == '1') {
                    Mail::to($admin['email'])->send(new RefundRequest($order->id));
                }
            } catch (\Exception $ex) {
                info($ex->getMessage());
            }
            return response()->json(['message' => translate('messages.refund_request_placed_successfully')], 200);
        }

        return response()->json([
            'errors' => [
                ['code' => 'order', 'message' => translate('messages.you_can_not_request_for_refund_after_delivery')]
            ]
        ], 403);
    }

    public function update_payment_method(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'guest_id' => $request->user ? 'nullable' : 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        $config = Helpers::get_business_settings('cash_on_delivery');
        if ($config['status'] == 0) {
            return response()->json([
                'errors' => [
                    ['code' => 'cod', 'message' => translate('messages.Cash on delivery order not available at this time')]
                ]
            ], 403);
        }
        $user_id = $request->user ? $request->user->id : $request['guest_id'];
        $order = Order::where(['user_id' => $user_id, 'id' => $request['order_id']])->Notpos()->first();
        if ($order) {
            Order::where(['user_id' => $user_id, 'id' => $request['order_id']])->update([
                'payment_method' => 'cash_on_delivery', 'order_status' => 'pending', 'pending' => now()
            ]);
            $order_mail_status = Helpers::get_mail_status('place_order_mail_status_user');
            $order_verification_mail_status = Helpers::get_mail_status('order_verification_mail_status_user');
            $address = json_decode($order->delivery_address, true);
            try {

                Helpers::send_order_notification($order);

                if ($order->is_guest == 0 && config('mail.status') && $order_mail_status == '1' && $order->customer) {
                    Mail::to($order->customer->email)->send(new PlaceOrder($order->id));
                }
                if ($order->is_guest == 1 && config('mail.status') && $order_mail_status == '1' && isset($address['contact_person_email'])) {
                    Mail::to($address['contact_person_email'])->send(new PlaceOrder($order->id));
                }
            } catch (\Exception $e) {
                info($e->getMessage());
            }
            return response()->json(['message' => translate('messages.payment_method_updated_successfully')], 200);
        }
        return response()->json([
            'errors' => [
                ['code' => 'order', 'message' => translate('messages.not_found')]
            ]
        ], 404);
    }

    public function cancellation_reason(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'limit' => 'required',
            'offset' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $limit = $request->query('limit', 1);
        $offset = $request->query('offset', 1);

        $reasons = OrderCancelReason::where('status', 1)->when($request->type, function ($query) use ($request) {
            return $query->where('user_type', $request->type);
        })
            ->paginate($limit, ['*'], 'page', $offset);
        $data = [
            'total_size' => $reasons->total(),
            'limit' => $limit,
            'offset' => $offset,
            'reasons' => $reasons->items(),
        ];
        return response()->json($data, 200);
    }


    public function food_list(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'food_id' => 'required',
        ]);

        $food_ids = json_decode($request['food_id'], true);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        $product = Food::active()->whereIn('id', $food_ids)->get();
        return response()->json(Helpers::product_data_formatting($product, true, false, app()->getLocale()), 200);
    }


    public function order_notification(Request $request, $order_id)
    {
        $user_id = $request->user ? $request->user->id : $request['guest_id'];
        $order = Order::where('user_id', $user_id)->where('id', $order_id)->with('restaurant')->first();
        $payments = $order->payments()->where('payment_method', 'cash_on_delivery')->exists();

        if ($order && $order->restaurant) {
            $restaurant = $order->restaurant;
            $rest_sub = $restaurant?->restaurant_sub;

            if ($restaurant->restaurant_model == 'subscription' && isset($rest_sub) && (!in_array($order->payment_method, ['digital_payment', 'partial_payment', 'offline_payment']) || $payments)) {
                if ($rest_sub->max_order != "unlimited" && $rest_sub->max_order > 0) {
                    $rest_sub->decrement('max_order', 1);
                }
            }
        }
        if ($order && (!in_array($order->payment_method, ['digital_payment', 'partial_payment', 'offline_payment']) || $payments)) {
            Helpers::send_order_notification($order);
        }
        return response()->json();
    }

    public function most_tips()
    {
        $data = Order::whereNot('dm_tips', 0)->get()->mode('dm_tips');
        $data = ($data && (count($data) > 0)) ? $data[0] : null;
        return response()->json([
            'most_tips_amount' => $data
        ], 200);
    }
    public function order_again(Request $request)
    {
        if (!$request->hasHeader('zoneId')) {
            $errors = [];
            array_push($errors, ['code' => 'zoneId', 'message' => translate('messages.zone_id_required')]);
            return response()->json([
                'errors' => $errors
            ], 403);
        }

        $longitude = $request->header('longitude') ?? 0;
        $latitude = $request->header('latitude') ?? 0;
        $user_id = $request->user ? $request->user->id : $request['guest_id'];
        $zone_id = json_decode($request->header('zoneId'), true);
        $data = Restaurant::withOpen($longitude, $latitude)->wherehas('orders', function ($q) use ($user_id) {
            $q->where('user_id', $user_id)->where('is_guest', 0)->latest();
        })

            ->withcount('foods')
            ->with(['foods_for_reorder'])
            ->Active()
            ->whereIn('zone_id', $zone_id)
            ->take(20)
            ->orderBy('open', 'desc')
            ->get()
            ->map(function ($data) {
                $data->foods = $data->foods_for_reorder->take(5);
                unset($data->foods_for_reorder);
                return $data;
            });
        return response()->json(Helpers::restaurant_data_formatting($data, true), 200);
    }

    public function offline_payment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'method_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $config = Helpers::get_mail_status('offline_payment_status');
        if ($config == 0) {
            return response()->json([
                'errors' => [
                    ['code' => 'offline_payment_status', 'message' => translate('messages.offline_payment_for_the_order_not_available_at_this_time')]
                ]
            ], 403);
        }
        $order = Order::find($request->order_id);

        $offline_payment_info = [];
        $method = OfflinePaymentMethod::where(['id' => $request->method_id, 'status' => 1])->first();

        if (!$method || !$order) {
            return response()->json([
                'errors' => [
                    ['code' => 'offline_payment_order_or_method', 'message' => translate('messages.offline_payment_order_or_method_not_found')]
                ]
            ], 403);
        }

        try {
            $fields = array_column($method->method_informations, 'customer_input');
            $values = $request->all();

            $offline_payment_info['method_id'] = $request->method_id;
            $offline_payment_info['method_name'] = $method->method_name;
            foreach ($fields as $field) {
                if (key_exists($field, $values)) {
                    $offline_payment_info[$field] = $values[$field];
                }
            }

            $OfflinePayments = OfflinePayments::firstOrNew(['order_id' => $order->id]);
            $OfflinePayments->payment_info = json_encode($offline_payment_info);
            $OfflinePayments->customer_note = $request->customer_note;
            $OfflinePayments->method_fields = json_encode($method?->method_fields);
            DB::beginTransaction();
            $OfflinePayments->save();
            $order->save();
            DB::commit();


            $data = [
                'title' => translate('messages.order_push_title'),
                'description' => translate('messages.new_order_push_description'),
                'order_id' => $order->id,
                'image' => '',
                'order_type' => $order->order_type,
                'zone_id' => $order->zone_id,
                'type' => 'new_order',
            ];
            Helpers::send_push_notif_to_topic($data, 'admin_message', 'order_request', url('/') . '/admin/order/list/all');

            return response()->json([
                'payment' => 'success'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['payment' => $e->getMessage()], 403);
        }
    }


    public function update_offline_payment_info(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        $info = OfflinePayments::where('order_id', $request->order_id)->first();
        $order = Order::find($request->order_id);

        if (!$info || !$order) {
            return response()->json([
                'errors' => [
                    ['code' => 'offline_payment_order_or_method', 'message' => translate('messages.offline_payment_order_or_method_not_found')]
                ]
            ], 403);
        }
        $old_data =   json_decode($info->payment_info, true);
        $method_id = data_get($old_data, 'method_id', null);
        $method = OfflinePaymentMethod::where('id', $method_id)->first();

        if (!$method) {
            return response()->json([
                'errors' => [
                    ['code' => 'offline_payment_order_or_method', 'message' => translate('messages.offline_payment_method_not_found')]
                ]
            ], 403);
        }
        $offline_payment_info = [];
        $fields = array_column($method->method_informations, 'customer_input');
        $values = $request->all();
        $offline_payment_info['method_id'] = $method->id;
        $offline_payment_info['method_name'] = $method->method_name;
        foreach ($fields as $field) {
            if (key_exists($field, $values)) {
                $offline_payment_info[$field] = $values[$field];
            }
        }

        $info->customer_note = $request->customer_note;
        $info->payment_info = json_encode($offline_payment_info);
        $info->status = 'pending';
        $info->save();

        return response()->json(['payment' => 'Payment_Info_Updated_successfully'], 200);
    }

    public function getPendingReviews(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        $foodIds = [];
        $itemIds = [];

        $orderDetails = OrderDetail::whereOrderId($request->order_id)->get(['id', 'food_id', 'item_campaign_id', 'food_details']);
        foreach ($orderDetails as $detail) {
            $foodIds[] = $detail->food_id;
            $itemIds[] = $detail->item_campaign_id;
        }
        $reviews =   Review::whereOrderId($request->order_id)->where(function ($query) use ($foodIds, $itemIds) {
            $query->whereIn('food_id', $foodIds)->orWhereIn('item_campaign_id', $itemIds);
        })->get(['id', 'food_id', 'item_campaign_id'])->toArray();

        $reviewedFoodIds = array_column($reviews, 'food_id');
        $reviewedItemIds = array_column($reviews, 'item_campaign_id');
        $storage = [];
        foreach ($orderDetails as $detail) {
            if (!in_array($detail->food_id, $reviewedFoodIds) || !in_array($detail->item_campaign_id, $reviewedItemIds)) {
                $detail['food_details'] = json_decode($detail['food_details'], true);
                $storage[] = $detail;
            }
        }
        return response()->json(['details' => $storage], 200);
    }


    private function createCashBackHistory($order_amount, $user_id, $order_id)
    {
        $cashBack =  Helpers::getCalculatedCashBackAmount(amount: $order_amount, customer_id: $user_id);
        if (data_get($cashBack, 'calculated_amount') > 0) {
            $CashBackHistory = new CashBackHistory();
            $CashBackHistory->user_id = $user_id;
            $CashBackHistory->order_id = $order_id;
            $CashBackHistory->calculated_amount = data_get($cashBack, 'calculated_amount');
            $CashBackHistory->cashback_amount = data_get($cashBack, 'cashback_amount');
            $CashBackHistory->cash_back_id = data_get($cashBack, 'id');
            $CashBackHistory->cashback_type = data_get($cashBack, 'cashback_type');
            $CashBackHistory->min_purchase = data_get($cashBack, 'min_purchase');
            $CashBackHistory->max_discount = data_get($cashBack, 'max_discount');
            $CashBackHistory->save();

            $CashBackHistory?->order()->update([
                'cash_back_id' => $CashBackHistory->id
            ]);
        }
        return true;
    }
}
