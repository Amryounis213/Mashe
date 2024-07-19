<?php

namespace App\Http\Resources\Api\Transactions;

use App\Http\Resources\Api\AddOn\AddOnResource;
use App\Models\AddOn;
use App\Models\CustomerWalletTransaction;
use App\Models\Favourite;
use App\Models\Restaurant;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $movement_type = $this->movements_type;
        $transaction = $this;
        $relation = null;
        switch ($movement_type) {
            case 'user':
                if ($this->referance) {
                    $transaction = CustomerWalletTransaction::where('id', $this->referance)->first();
                    $User = $transaction->Wallet->User;
                    $relation = [
                        'id' => $User->id,
                        'name' => $User->full_name,
                        'logo' => $User->image_path,
                        'phone' =>  $User->phone,
                    ];
                } else {

                    $User = $this->Wallet->User;
                    $relation = [
                        'id' => $User->id,
                        'name' => $User->full_name,
                        'logo' => $User->image_path,
                        'phone' =>  $User->phone,
                    ];
                }

                break;
            case 'resturant':
               
                $Rest = Restaurant::select('id' , 'name' , 'logo')->where('id' , $this->referance)->first();
                $relation = [
                    'id' => $Rest->id,
                    'name' => $Rest->name,
                    'logo' => $Rest->logo,
                    'phone' =>  $Rest->phone,
                ];
                break;
        }

        return [
            "id" => $this->transaction_id,
            "operation" => $this->type == 'withdraw' ? 'CREDIT' : 'DEBIT',
            "amount" => $this->amount,
            "type" => $this->type,
            "createdAt" => $this->created_at->format('Y-m-d H:i'),
            "signal" => $this->type == 'withdraw' ? '-' : '+',
            "color" => $this->type == 'withdraw' ? 'red' : 'green',
            'relation' => $relation,
        ];
    }
}
