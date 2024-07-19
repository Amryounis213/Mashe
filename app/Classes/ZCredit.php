<?php

namespace App\Classes;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class ZCredit
{
    public $terminal_number;
    public $pass;
    public function __construct()
    {
        $this->terminal_number = env('HYP_PAY_MASOF');
        $this->pass = env('HYP_PAY_PASS');
    }


    public function CommitFullTransaction($CNUMBER , $CVV , $EXP , $amount = 1 , $user)
    {


        $response = Http::withHeaders([
            'Content-Type' => 'application/json; charset=utf-8',
        ])->post('https://pci.zcredit.co.il/ZCreditWS/api/Transaction/CommitFullTransaction', [
            "TerminalNumber" =>  $this->terminal_number,
            "Password" => $this->pass ,
            "Track2" => "",
            "CardNumber" => $CNUMBER,
            "CVV" => $CVV,
            "ExpDate_MMYY" => $EXP,
            "TransactionSum" => (float)$amount ,
            "NumberOfPayments" => "1",
            "FirstPaymentSum" => "0",
            "OtherPaymentsSum" => "0",
            "TransactionType" => "01",
            "CurrencyType" => "1",
            "CreditType" => "1",
            "J" => "0",
            "IsCustomerPresent" => "false",
            "AuthNum" => "",
            "HolderID" => "",
            "ExtraData" => "",
            "CustomerName" => $user->name,
            "CustomerAddress" => $user->address,
            "CustomerEmail" => $user->email,
            "PhoneNumber" => $user->phone,
            "ItemDescription" => "",
            "ObeligoAction" => "",
            "OriginalZCreditReferenceNumber" => "",
            "TransactionUniqueIdForQuery" => "",
            "TransactionUniqueID" => "",
            "UseAdvancedDuplicatesCheck" => ""
        ]);

        // To get the response
        $responseBody = $response->body(); // Or use $response->json() if the response is JSON

    }
}
