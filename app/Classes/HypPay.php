<?php

namespace App\Classes;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class HypPay 
{
    public $masof ;
    public $pass ;
    public function __construct()
    {   
        $this->masof = env('HYP_PAY_MASOF');
        $this->pass = env('HYP_PAY_PASS');
    }


    public function Pay($amount = 1) 
    {
        $url = 'https://pay.hyp.co.il/p/';
        $params = [
            "action" => "pay",
            "Masof" => $this->masof,
            "Info" => "Transaction desctiption",
            "Amount" => $amount,
            "UTF8" => "True",
            "UTF8out" => "True",
            "J5" => "False",
            "PassP" => $this->pass ,
            "UserId" => "203269535",
            "ClientName" => "bashar",
            "ClientLName" => "bashar",
            "street" => "New York",
            "city" => "New York",
            "zip" => "xxxx",
            "phone" => "+00",
            "cell" => "+00",
            "email" => "abc@yaad.net",
            "Order" => "order information",
            "Tash" => "2",
            "FixTash" => "True",
            "Postpone" => "True",
            "Sign" => "True",
            "MoreData" => "True",
            "sendemail" => "True",
            "Coin" => "1",
            'PageLang' => 'ENG',
           
        ];

       
        //  $response = Http::post('https://pay.hyp.co.il/p/', $params);
        $full_url = $url . '?' . http_build_query($params) ;

        return $full_url;
;
    }
}