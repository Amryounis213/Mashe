<?php

namespace App\Http\Resources\Api\Users;

use App\Http\Resources\Api\Services\ServiceResource;
use App\Models\Order;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResourceWithoutToken extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'birth_date'=> $this->birth_date,
            'id_number'=> $this->id_number ,
            'image' => $this->image_path,
            'phone'=> $this->phone,
            'email'=> $this->email ,
            'token' => $this->token,
            'status'=> $this->status,
            'gender'=> $this->gender ,
            'wallet_balance'=> $this->Wallet->balance ,
            'orders'=> Order::where('user_id' , auth('user')->id())->latest()->select('id' , 'order_num')->get(), 
        ];
       
    }
}
