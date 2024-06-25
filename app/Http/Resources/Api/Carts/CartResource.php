<?php

namespace App\Http\Resources\Api\Carts;

use App\Http\Resources\Coupon\CouponResource;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\UserAddress\UserAddressResource;
use App\Models\BonusCard;
use App\Models\BonusUser;
use App\Models\CartResult;
use App\Models\Coupon;
use App\Models\CouponUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       
        $id = auth('api')->id() ;
       
        
        $items = [];
        return [
            // 'id' => $this->id,
            'subtotal' => $this ->subtotal,
            'discount' => $this ->discount,
            'tax' => $this ->tax,
            'distance' => $this ->distance,
            'fees' => $this ->fees,
            'delivery_fee' => $this ->delivery_fee,
            'delivery_tip' => $this ->delivery_tip,
            'total' => $this ->total,
            // 'items' => $this->items,
        ];
    }
}
