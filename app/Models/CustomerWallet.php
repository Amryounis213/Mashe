<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerWallet extends Model
{
    use HasFactory;

    public function Transactions()
    {
        return $this->hasMany(CustomerWalletTransaction::class , 'wallet_id')->orderBy('created_at' , 'DESC');
    }

    
}
