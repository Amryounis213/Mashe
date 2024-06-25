<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketWallet extends Model
{
    use HasFactory;
    protected $table = 'markets_wallets';
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['vendor_id'];

    public function getBalanceAttribute()
    {
        if ($this->total_earning <= 0){
            return (float)0;
        }
        return (float) round(($this->total_earning - ($this->total_withdrawn + $this->pending_withdraw + $this->collected_cash)) , 8);    }
}
