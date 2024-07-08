<?php

namespace App\Http\Resources\Api\Transactions;

use App\Http\Resources\Api\AddOn\AddOnResource;
use App\Models\AddOn;
use App\Models\Favourite;
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
        return [
            "id"=>$this->transaction_id,
            "operation"=> $this->type == 'withdraw' ? 'CREDIT' : 'DEBIT',
            "amount"=> $this->amount ,
            "type"=> $this->type ,
            "createdAt"=>$this->created_at->format('Y-m-d H:i'),
            "signal"=> $this->type == 'withdraw' ? '-' : '+' ,
            "color" => $this->type == 'withdraw' ? 'red' : 'green'  ,
        ];
    }
}
