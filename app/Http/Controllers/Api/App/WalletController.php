<?php

namespace App\Http\Controllers\Api\App;

use App\CentralLogics\Helpers;
use App\Classes\HypPay;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Transactions\TransactionResource;
use App\Models\BankAccount;
use App\Models\CardAccount;
use App\Models\CustomerWallet;
use App\Models\CustomerWalletTransaction;
use App\Models\User;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class WalletController extends Controller
{
    use ApiTrait;

    public function WalletPage()
    {
        $user = auth('api')->user();
        $recentContacts = [];

        $data = [
            'balance' => $user->Wallet?->balance,
            'transactions' => TransactionResource::collection($user->Wallet->Transactions ?? [])
        ];

        return $this->SuccessApi($data);
    }

    public function SendMoney(Request $request)
    {
        $request->validate([
            'amount' => 'required',
            'phone' => 'required|exists:users,phone',
            'notice' => 'nullable',
        ]);

        if ($request->phone == auth('api')->user()->phone)
            return $this->FailedApi('you cannot send money to yourself', 422);

        $SenderWallet = CustomerWallet::where('user_id', auth('api')->id())->first();
        if ($SenderWallet->balance < $request->amount)
            return $this->FailedApi('The wallet balance not enough', 422);


        $Reciver = User::where('phone', $request->phone)->first();
        $ReciverWallet = CustomerWallet::where('user_id', $Reciver->id)->first();


        $ReciverWallet->balance = $ReciverWallet->balance + $request->amount;
        $ReciverWallet->save();

        $SenderWallet->balance = $SenderWallet->balance - $request->amount;
        $SenderWallet->save();

        //store new transactions from sender
        $S_transaction = new CustomerWalletTransaction();
        $S_transaction->wallet_id  = $SenderWallet->id;
        $S_transaction->type = 'withdraw';
        $S_transaction->amount = $request->amount;
        $S_transaction->transaction_id = Str::uuid();
        $S_transaction->referance = null;
        $S_transaction->save();

        //store new transactions from receiver
        $R_transaction = new CustomerWalletTransaction();
        $R_transaction->wallet_id  = $ReciverWallet->id;
        $R_transaction->type = 'deposit';
        $R_transaction->amount = $request->amount;
        $R_transaction->transaction_id = Str::uuid();
        $R_transaction->referance = $S_transaction->id;
        $R_transaction->save();



        return $this->SuccessApi(null, translate('Operation successful'));
    }



    public function TopUp(Request $request)
    {
        $request->validate([
            'amount' => 'required|min:1|max:1000000|numeric',
        ]);

        $Wallet = CustomerWallet::where('user_id', auth('api')->id())->first();
        $Wallet->balance = $Wallet->balance + $request->amount;
        $Wallet->save();

        //store new transactions from sender
        $S_transaction = new CustomerWalletTransaction();
        $S_transaction->wallet_id  = $Wallet->id;
        $S_transaction->type = 'deposit';
        $S_transaction->amount = $request->amount;
        $S_transaction->transaction_id = Str::uuid();
        $S_transaction->referance = null;
        $S_transaction->save();



        return $this->SuccessApi(null, translate('Operation successful'));
    }

    public function AddCard(Request $request)
    {

        // $request->validate([
        //     'number' => 'required',
        //     'cvv' => 'required|min:3|max:3',
        //     'holder_name' => 'required',
        //     'customer_id' => 'required',
        //     'expiry_date' => 'required',
        // ]);
        // // Extract card details from the request
        // $cardNumber = $request->input('number');
        // $expiryDate = $request->input('expiry_date');
        // $cardHolder = $request->input('card_holder');

        // // Check if card is Visa or MasterCard
        // if (preg_match('/^4[0-9]{12}(?:[0-9]{3})?$/', $cardNumber)) {
        //     $cardType = 'Visa';
        // } elseif (preg_match('/^5[1-5][0-9]{14}$/', $cardNumber)) {
        //     $cardType = 'MasterCard';
        // } else {
        //     return response()->json(['error' => 'Card is neither Visa nor MasterCard'], 400);
        // }

        // // Check if the card is already in the database
        // $existingCard = CardAccount::where('number', $cardNumber)->first();

        // if ($existingCard) {
        //     return response()->json(['error' => 'Card already exists in the database'], 400);
        // }

        // // Save card details to the database (without CVV)
        // $request->merge([

        // ]);

        // CardAccount::create([
        //     'number' => $cardNumber,
        //     'expiry_date' => $expiryDate,
        //     'holder_name' => $cardHolder,
        //     'user_id' => auth('api')->id(),
        //     'cvv'=> '1',
        // ]);

        // // CardAccount::create($request->all());
        // return $this->SuccessApi(null, 'Card saved Successfully');



        $url = 'https://pay.hyp.co.il/p/';

        $params = [
            'action' => 'getToken',
            'Masof' => '0010020610', // Replace with your actual terminal number
            'PassP' => '1234', // Replace with your actual authentication password
            'TransId' => '5211854', // Replace with your actual transaction ID
            'Fild1' => 'test', // Replace with your actual free field 1
            'Fild2' => 'demo', // Replace with your actual free field 2
            'Fild3' => 'order1234', // Replace with your actual free field 3
            'allowFalse' => 'True', // If needed, to allow acceptance of token for transactions without proper status
        ];

        try {
            $response = Http::get($url, $params);
            // return $response;
            // Handle response
            if ($response->successful()) {
                $token = $response->body(); // Assuming the token is returned in the response body
                // return $token;
                // Store the token or process as needed

                preg_match('/Token=([^&]*)/', $token, $matches);

                if (isset($matches[1])) {
                    $token = $matches[1];
                } else {
                    echo "Token not found in the string.";
                }

                return $this->SuccessApi($token, 'Card Account Saved Successfully');
                // return response()->json(['token' => ]);
            } else {
                $error = $response->body(); // Handle error response

                return response()->json(['error' => $error], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getCardAccounts()
    {
        $cards = CardAccount::select('number', 'expiry_date')->where('user_id', auth('api')->id())->get();
        return $this->SuccessApi($cards, 'cards return Successfully');
    }


    public function delete_card($id)
    {
        $card = CardAccount::where('id', $id)->delete();
        return $this->SuccessApi(null, 'Card Account Deleted Successfully');
    }

    public function ShowPageFrame()
    {
        $url = '"https://private-anon-323f609050-hypay.apiary-proxy.com/p/';
        $params = [
            "action" => "pay",
            "Masof" => "0010020610",
            "Info" => "Transaction desctiption",
            "Amount" => "5",
            "UTF8" => "True",
            "UTF8out" => "True",
            "J5" => "False",
            "PassP" => "1234",
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
            'CC' => '1109517305051990000',
            'Token' => 'True',
            'Tmonth' => '4',
            'Tyear' => '2025',
        ];
        // $response = Http::withHeaders([
        //     'Content-Type' => 'application/json',
        // ])->post('https://pay.hyp.co.il/p/', $params);

        $full_url = $url . '?' . http_build_query($params);
        return $full_url;
        // Handle the response as needed
        return $response->body();
    }


    public function GetYaadIframeUrl()
    {

        $user = auth('api')->user();
        $full_url = 'https://icom.yaad.net/cgi-bin/yaadpay/yaadpay3ds.pl/?Amount=30&ClientName=' . $user->name . '&Info=972537289982&J5=True&Masof=0010131918&MoreData=True&Order=GiveItName&PageLang=HEB&Sign=True&Tash=1&UTF8=True&UTF8out=True&action=pay&tmp=7';
        return $this->SuccessApi($full_url);
    }

    // //Visa Card Account
    // public function AddCard(Request $request)
    // {
    //     $request->validate([
    //         'number' => 'required',
    //         'cvv' => 'required|min:3|max:3',
    //         'holder_name'=> 'required',
    //         'customer_id'=> 'required',
    //         'expiry_date' => 'required',
    //     ]);

    //     $request->merge([
    //         'user_id' => auth('api')->id(),
    //     ]);

    //     CardAccount::create($request->all());
    //     return $this->SuccessApi(null, 'Card Account Created Successfully');
    // }


    // public function ShowPageFrame()
    // {
    //     $url = 'https://pay.hyp.co.il/p/';
    //     $params = [
    //         'Amount' => '1',
    //         'ClientLName' => 'bashar', // Replace with your actual terminal number
    //         'Coin' => '1', // Replace with your actual authentication password
    //         'TransId' => '5211854', // Replace with your actual transaction ID
    //         'Info' => 'page-frame', // Replace with your actual free field 1
    //         'Masof' => '0010131918', // Replace with your actual free field 2
    //         'PageLang' => 'ENG', // Replace with your actual free field 3
    //         'allowFalse' => 'True', // If needed, to allow acceptance of token for transactions without proper status
    //         'street' => 'lev',
    //         'J5' => 'false',
    //         'MoreData' => 'false',
    //         'SendHesh' => 'True',
    //         'ShowEngTashText' => 'True',
    //         'action' => 'pay',
    //         'cell' => '050555555555',
    //     ];


    //     $full_url = $url . '?' . http_build_query($params);
    //     return $this->SuccessApi($full_url);
    // }



    public function getBankAccounts()
    {
        $accounts = BankAccount::select('bank_name', 'number', 'code')->where('user_id', auth('api')->id())->get();
        return $this->SuccessResponse($accounts, 'Accounts return Successfully');
    }
}
