<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'f_name',
        'l_name',
        'phone',
        'email',
        'password',
        'login_medium',
        'ref_code',
        'ref_by',
        'social_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'interest',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_phone_verified' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'order_count' => 'integer',
        'wallet_balance' => 'float',
        'loyalty_point' => 'integer',
        'ref_by' => 'integer',
        'social_id' => 'integer',
    ];

    public function userinfo()
    {
        return $this->hasOne(UserInfo::class, 'user_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class)->where('is_guest', 0);
    }

    public function addresses()
    {
        return $this->hasMany(CustomerAddress::class);
    }

    public function loyalty_point_transaction()
    {
        return $this->hasMany(LoyaltyPointTransaction::class);
    }

    public function CartMemory()
    {
        return $this->hasOne(CartResult::class, 'user_id', 'id');
    }


    public function Wallet()
    {
        return $this->hasOne(CustomerWallet::class);
    }


    public function wallet_transaction()
    {
        return $this->hasMany(WalletTransaction::class);
    }

    public function category_visit_log()
    {
        return $this->morphedByMany(Category::class, 'visitor_log');
    }
    public function restaurant_visit_log()
    {
        return $this->morphedByMany(Restaurant::class, 'visitor_log');
    }


    public function getFullNameAttribute()
    {
        return $this->f_name . ' ' . $this->l_name;
    }

    // Add this function to your User model
    public function setPhoneAttribute($value)
    {
        // Remove the "+" sign from the phone number
        $this->attributes['phone'] = str_replace('+', '', $value);
    }


    // public function getPhoneAttribute()
    // {
    //     return str_replace('+', '', $this->phone);
    // }


    public function getImagePathAttribute()
    {
        if ($this->image) {
            return $this->image;
        }
        return 'https://www.shutterstock.com/image-illustration/call-center-staff-talking-provide-600nw-2074932583.jpg';
    }
}
