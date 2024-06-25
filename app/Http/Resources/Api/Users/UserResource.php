<?php

namespace App\Http\Resources\Api\Users;

use App\Http\Resources\Api\Address\AddressResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->f_name .' ' . $this->l_name ,           
            'image' => $this->image_path,
            'phone'=> $this->phone,
            'email'=> $this->email ,
            'token' => $this->token,
            'status'=> $this->status,
            'gender'=> $this->gender ,
            'wallet_balance'=> $this->Wallet->balance ,
            'myaddress' => $this->addresses ? AddressResource::collection($this->addresses) : [] ,
        ];
       
    }
}
