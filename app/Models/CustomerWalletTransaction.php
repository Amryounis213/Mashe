<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerWalletTransaction extends Model
{
    use HasFactory;

    public function Wallet()
    {
        return $this->belongsTo(CustomerWallet::class , 'wallet_id');
    }
}
