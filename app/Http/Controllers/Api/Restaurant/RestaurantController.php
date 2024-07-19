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

class RestaurantController extends Controller
{

    public function Open()
    {
    }

    public function Close()
    {
    }


    public function get_orders(Request $request)
    {

        $orders = Order::with(['restaurant'])
            ->where('restaurant_id' , auth('restaurants')->id())
            ->whereNotIn('order_status', ['delivered', 'canceled', 'refund_requested', 'refund_request_canceled', 'refunded', 'failed'])
            ->latest()
            ->paginate($request['limit'], ['*'], 'page', $request['offset']);
            

        $orders = array_map(function ($data) {
            $data['delivery_address'] = $data['delivery_address'] ? json_decode($data['delivery_address']) : $data['delivery_address'];
            $data['restaurant'] = $data['restaurant'] ? Helpers::restaurant_data_formatting($data['restaurant']) : $data['restaurant'];
            $data['delivery_man'] = $data['delivery_man'] ? Helpers::deliverymen_data_formatting([$data['delivery_man']]) : $data['delivery_man'];
            return $data;
        }, $orders);

        // $data = [
        //     'total_size' => $paginator->total(),
        //     'limit' => $request['limit'],
        //     'offset' => $request['offset'],
        //     'orders' => $orders
        // ];
        return response()->json($data, 200);
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
}
