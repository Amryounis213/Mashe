<?php

namespace App\Http\Controllers\Api\App;

use App\CentralLogics\Helpers;
use App\Classes\HypPay;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Cards\CardCollection;
use App\Http\Resources\Api\Cards\CardResource;
use App\Http\Resources\Api\Transactions\TransactionResource;
use App\Models\BankAccount;
use App\Models\CardAccount;
use App\Models\ContactHistory;
use App\Models\CustomerWallet;
use App\Models\CustomerWalletTransaction;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class WalletController extends Controller
{
    use ApiTrait;

    public function WalletPage()
    {
        $user = auth('api')->user();
        $recentContacts = [];

        $data = [
            'balance' => $user->Wallet?->balance,
            'contacts' => ContactHistory::where('user_id', $user->id)->get(),
            'transactions' => TransactionResource::collection($user->Wallet->Transactions ?? [])
        ];

        return $this->SuccessApi($data);
    }

    public function SendMoney(Request $request)
    {
        $request->validate([
            'amount' => 'required',
            'phone' => 'required',
            'notice' => 'nullable',
            'confirm_send' => 'nullable',
        ]);
        $confirm_send = $request->confirm_send == 1 ? 1 : 0;

        if ($request->phone == auth('api')->user()->phone)
            return $this->FailedApi('you cannot send money to yourself', 422);

        $SenderWallet = CustomerWallet::where('user_id', auth('api')->id())->first();
        if ($SenderWallet->balance < $request->amount)
            return $this->FailedApi('The wallet balance not enough', 422);



        $Reciver = User::where('phone', $request->phone)->first();
        if ($Reciver && ($confirm_send == 0)) {

            $data = [
                'id' => $Reciver->id,
                'name' => $Reciver->full_name,
                'logo' => $Reciver->image_path,
                'phone' => $Reciver->phone,
                'amount' => $request->amount,
            ];

            return $this->SuccessApi($data, translate('data return successfully'));
        } elseif ($Reciver && ($confirm_send == 1)) {
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


            //store new transactions from receiver
            $R_transaction = new CustomerWalletTransaction();
            $R_transaction->wallet_id  = $ReciverWallet->id;
            $R_transaction->type = 'deposit';
            $R_transaction->amount = $request->amount;
            $R_transaction->transaction_id = Str::uuid();
            $R_transaction->referance = $S_transaction->id;
            $R_transaction->save();



            $S_transaction->referance = $R_transaction->id;
            $S_transaction->save();


            // SaveContacts
            $this->SaveContacts($Reciver);

            $msg = translate('you have successfully paid ') . $request->amount . '  ' . translate('to') . '  ' . $Reciver->full_name . '.';
            $tranactionData = [
                'transaction_id' => $S_transaction->id,
                'transaction_date' => $S_transaction->created_at->format('Y/m/d'),
                'transaction_time' => $S_transaction->created_at->format('H:i A'),
            ];
            return $this->SuccessApi($tranactionData,  $msg);
        } else {
            return $this->FailedApi(translate('this_user_not_register_in_app'));
        }
    }

    public function SaveContacts($Reciver)
    {
        $payfee = ContactHistory::where('phone', $Reciver->phone)->where('user_id', auth('api')->id())->first();
        if (!$payfee) {
            $payfee = new ContactHistory();
            $payfee->name = $Reciver->full_name;
            $payfee->phone = $Reciver->phone;
            $payfee->user_id = auth('api')->id();
            $payfee->save();
        }
        return null;
    }

    public function PaymentMethods()
    {
        $payment_methods = PaymentMethod::where('status', true)->get(['id', 'name']);
        return $this->SuccessApi($payment_methods, translate('payments_methods'));
    }

    public function TopUp(Request $request)
    {
        $request->validate([
            'amount' => 'required|min:1|max:1000000|numeric',
            'card_id' => [Rule::requiredIf(in_array($request->get('payment_method'), [2]))],
        ]);
        $userId = auth('api')->id();

        // Retrieve the card only if it belongs to the authenticated user
        $card = CardAccount::where('id', $request->card_id)
            ->where('user_id', $userId)
            ->first();

        if (!$card) {
            // If the card does not belong to the authenticated user, return an error response
            return response()->json(['error' => 'Card not found or does not belong to the authenticated user.'], 404);
        }

        if ($request->card_id) {
            $card = CardAccount::where('id', $request->card_id)->first();

            // Call the softPay function
            $payNow = $this->softPay($card->token, $request->amount, $card->Tmonth, $card->Tyear);
            // Get the response body as a string
            $responseString = $payNow->body();
            // Parse the response string into an associative array
            parse_str($responseString, $responseData);
            $decodedErrMsg = urldecode($responseData['errMsg']);

            // Check if the request was successful
            if ($payNow->successful() && isset($responseData['CCode']) && $responseData['CCode'] == '0') {
                $Wallet = CustomerWallet::where('user_id', auth('api')->id())->first();
                $Wallet->balance = $Wallet->balance + $request->amount;
                $Wallet->save();

                // Store new transactions from sender
                $S_transaction = new CustomerWalletTransaction();
                $S_transaction->wallet_id = $Wallet->id;
                $S_transaction->type = 'deposit';
                $S_transaction->amount = $request->amount;
                $S_transaction->transaction_id = Str::uuid();
                $S_transaction->referance = null;
                $S_transaction->save();

                // Return the full parsed API response
                return $this->SuccessApi(null, translate('The wallet balance has been recharged successfully'));
            } else {

                // Return the response string directly if not successful
                return $this->SuccessApi(null, translate('Credit Card has been declined: ' . $decodedErrMsg));
            }
        }
    }

    public function getTokenForCard(Request $request)
    {
        $transId = $request->transId;
        $CCode = $request->CCode;
        $Tyear = $request->Tyear;
        $L4digit = $request->L4digit;
        $Tmonth = $request->Tmonth;
        $Issuer = $request->Issuer;
        $Brand  = $request->Brand ;

        $url = 'https://pay.hyp.co.il/p/';
        $params = [
            'action' => 'getToken',
            'Masof' => env('HYP_PAY_MASOF'), // Replace with your actual terminal number
            'PassP' => env('HYP_PAY_PASS'), // Replace with your actual authentication password
            'TransId' => $transId ?? '196195054', // Replace with your actual transaction ID
            'Fild1' => 'test', // Replace with your actual free field 1
            'Fild2' => 'demo', // Replace with your actual free field 2
            'Fild3' => 'order1234', // Replace with your actual free field 3
            'allowFalse' => 'True', // If needed, to allow acceptance of token for transactions without proper status
        ];

        try {
            $response = Http::get($url, $params);

            if ($response->successful()) {
                $token = $response->body(); // Assuming the token is returned in the response body
                // Store the token or process as needed
                preg_match('/Token=([^&]*)/', $token, $matches);
                if (isset($matches[1])) {
                    $token = $matches[1];
                    $Transaction =  $this->softPay($token, 10, $request->Tmonth, $request->Tyear);
                    parse_str($Transaction, $parsedData);


                    //  preg_match('/Id=([^&]*)/', $Transaction, $IDmatches);
                } else {
                    echo "Token not found in the string.";
                }

                CardAccount::create([
                    'token' => $token,
                    'last_4_digits' => $parsedData['L4digit'],
                    'Tmonth' => $parsedData['Tmonth'],
                    'Tyear' => $parsedData['Tyear'],
                    'brand' => $parsedData['Brand'],
                    'issuer' => $parsedData['Issuer'],
                    'user_id' => auth('api')->id(),
                ]);

                return $this->SuccessApi(null, 'Card Token Saved Successfully');
                // return response()->json(['token' => ]);
            } else {
                $error = $response->body(); // Handle error response

                return response()->json(['error' => $error], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function AddCard(Request $request)
    {
        $Id = $request->Id;
        $CCode = $request->CCode;
        $Info = $request->Info;
    
        if ($CCode !== "0") {
            return $this->FailedApi(translate('Transaction declined with CCode: ' . $CCode));
        }
    
        $url = 'https://pay.hyp.co.il/p/';
        $params = [
            'action' => 'getToken',
            'Masof' => env('HYP_PAY_MASOF'), // Replace with your actual terminal number
            'PassP' => env('HYP_PAY_PASS'), // Replace with your actual authentication password
            'TransId' => $Id, // Replace with your actual transaction ID
            'allowFalse' => 'True', // If needed, to allow acceptance of token for transactions without proper status
        ];
    
        try {
            $response = Http::get($url, $params);
    
            if ($response->successful()) {
                $FullTokenResponse = $response->body(); // Assuming the token is returned in the response body
    
                // Parse the URL-encoded string into an associative array
                parse_str($FullTokenResponse, $parsedResponse);
    
                // Extract the Token parameter
                $token = $parsedResponse['Token'] ?? null;
    
                if (!$token) {
                    return $this->FailedApi(translate('Token not found in the response'));
                }
    
                // Store the token or process as needed
                $user = User::where('phone', $Info)->first();
    
                if (!$user) {
                    return $this->FailedApi(translate('User not found with phone: ' . $Info));
                }
    
                $userId = $user->id;
                $CheckCardIfExists = CardAccount::where('transaction_id', $Id)->exists();
    
                if ($CheckCardIfExists) {
                    return $this->FailedApi(translate('Card already exists'));
                }
    
                $card = CardAccount::create([
                    'token' => $token,
                    'last_4_digits' => $request->L4digit,
                    'Tmonth' => $request->Tmonth,
                    'Tyear' => $request->Tyear,
                    'brand' => $request->Brand,
                    'issuer' => $request->Issuer,
                    'holder_name' => $request->holder_name,
                    'holder_id' => $request->UserId,
                    'user_id' => $userId,
                    'transaction_id' => $Id,
                ]);
    
                return $this->SuccessApi(null, translate('Card added successfully: ' . json_encode($token)));
            } else {
                $error = $response->body(); // Handle error response
                return $this->FailedApi(translate('Failed to get token from gateway: ' . $error));
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    

    public function softPay($token, $amount = 1, $m, $y, $LName = 'mashe', $FName = 'mashe')
    {
        $user = auth('api')->user();

        $response = Http::withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded',
        ])->asForm()->post('https://pay.hyp.co.il/p/', [
            'action' => 'soft',
            'Masof' => env('HYP_PAY_MASOF'),
            'PassP' => env('HYP_PAY_PASS'),
            'Amount' => $amount,
            'CC' => (string)$token,
            'Tmonth' => $m,
            'Tyear' => $y,
            'Coin' => '1',
            'Info' => 'test-api',
            'Order' => '12345678910',
            'Tash' => '1',
            'UserId' => '203269535',
            'ClientLName' => $user ? $user->l_name : $LName,
            'ClientName' => $user  ? $user->f_name : $FName,
            'cell' => '050555555555',
            'J5' => 'False',
            'MoreData' => 'True',
            'UTF8' => 'True',
            'UTF8out' => 'True',
            'Token' => 'True',
        ]);

        return $response;
    }


    public function getCardAccounts()
    {
        $cards = CardAccount::where('user_id', auth('api')->id())->get();
        return new CardCollection($cards);

        // return $this->SuccessApi($cards, 'cards return Successfully');
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
        $SIGN1 = $this->GetSign();

        parse_str($SIGN1, $responseArray);
        if (isset($responseArray['signature'])) {
            $signature = $responseArray['signature'];
            $amount = $responseArray['Amount'];
            $Masof = env('HYP_PAY_MASOF');
            $lang = $responseArray['PageLang'];
        } else {
            echo 'Signature not found in the response';
        }


        $full_url = 'https://pay.hyp.co.il/cgi-bin/yaadpay/yaadpay3ds.pl/?' . $SIGN1;

        // $full_url = 'https://icom.yaad.net/cgi-bin/yaadpay/yaadpay3ds.pl/?Amount='. $amount  .'&ClientName=' . $user->name . '&Info=972537289982&J5=True&Masof=' . env('HYP_PAY_MASOF') . '&MoreData=True&Order=GiveItName&PageLang=HEB&Sign=True&Tash=1&UTF8=True&UTF8out=True&action=pay&tmp=7';
        return $this->SuccessUrlApi($full_url, 'success', 200, $signature);
    }

    public function SuccessUrlApi($user = null, $msg = 'SUCCESS', $code = 200, $signature)
    {
        $data = [
            'status' => true,
            'code' => $code,
            'message' => $msg,
            'data' => $user,
            // 'signature' => $signature,
        ];
        return response()->json($data, $code);
    }



    function GetSign()
    {
        $user = auth('api')->user();
        $phone = $user->phone;
        $lang = 'ENG';

        $url = 'https://pay.hyp.co.il/p/?action=APISign&What=SIGN&KEY=' . env('HYP_PAY_KEY') . '&PassP=' . env('HYP_PAY_PASS') . '&Masof=' . env('HYP_PAY_MASOF') . '&Order=12345678910&Info='. $phone . '&Amount=0.1&UTF8=True&UTF8out=True&UserId=890108566&ClientName=' . $user->f_name . '' . $user->l_name . '&Coin=1&J5=False&Sign=True&MoreData=True&SendHesh=True&Pritim=False&PageLang=' . $lang  . '&Tash=1&action=pay&tmp=7';

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo 'cURL Error #:' . $err;
        } else {
            return $response;
        }
    }

    public function getBankAccounts()
    {
        $accounts = BankAccount::select('bank_name', 'number', 'code')->where('user_id', auth('api')->id())->get();
        return $this->SuccessResponse($accounts, 'Accounts return Successfully');
    }
}