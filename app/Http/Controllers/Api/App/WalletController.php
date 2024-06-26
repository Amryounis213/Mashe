<?php

namespace App\Http\Controllers\Api\App;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use App\Models\CardAccount;
use App\Models\CustomerWallet;
use App\Models\User;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    use ApiTrait;
   
    public function WalletPage()
    {
        $user = auth('api')->user();
        $recentContacts = [];

        $data = [
            'balance' => $user->Wallet?->balance ,
            'transactions'=> $user->Wallet->Transactions 
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

        if ($request->mobile == auth('api')->user()->mobile)
            return $this->FailedApi('you cannot send money to yourself', 422);

        $SenderWallet = CustomerWallet::where('user_id', auth('api')->id())->first();
        if ($SenderWallet->balance < $request->amount)
            return $this->FailedApi('The wallet balance not enough', 422);


        $Reciver = User::where('phone', $request->phone)->first();
        $ReciverWallet = CustomerWallet::where('user_id' , $Reciver->id)->first();

       

        $ReciverWallet->balance = $ReciverWallet->balance + $request->amount;
        $ReciverWallet->save();

        $SenderWallet->balance = $SenderWallet->balance - $request->amount;
        $SenderWallet->save();


        //notification 
        // $this->SendNotifcation($Reciver->id, get_class($Reciver), $notification['type'], $notification['title'], $notification['details'], $financial->id, auth('api')->id());


        return $this->SuccessApi(null , 'send successfully');
       
    }


    public function AddPayfee()
    {

    }

    //Visa Card Account
    public function AddCard(Request $request)
    {
        $request->validate([
            'number' => 'required',
            'cvv' => 'required|min:3|max:3',
            'holder_name'=> 'required',
            'customer_id'=> 'required',
            'expiry_date' => 'required',
        ]);

        $request->merge([
            'user_id' => auth('api')->id(),
        ]);

        CardAccount::create($request->all());
        return $this->SuccessApi(null, 'Card Account Created Successfully');
    }

    public function getBankAccounts()
    {
        $accounts = BankAccount::select('bank_name', 'number', 'code')->where('user_id', auth('api')->id())->get();
        return $this->SuccessResponse($accounts, 'Accounts return Successfully');
    }


    public function getCardAccounts()
    {
        $cards = CardAccount::select('number', 'expiry_date')->where('user_id', auth('api')->id())->get();
        return $this->SuccessApi($cards, 'cards return Successfully');
    }

    public function delete_card($id)
    {
        $card = CardAccount::where('id' , $id)->delete();
        return $this->SuccessApi(null, 'Card Account Deleted Successfully');

    }


   
}
