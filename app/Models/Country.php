<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Objects\Polygon;

class Country extends Model
{
    use HasFactory;
    protected $casts = [
        'id'=>'integer',
        'coordinates' => Polygon::class,
    ];

    public function City()
    {
        return $this->hasMany(Zone::class , 'country_id');
    }

    public function restaurants()
    {
        return $this->hasManyThrough(Restaurant::class , Zone::class);
    }

    public function deliverymen()
    {
        return $this->hasManyThrough(DeliveryMan::class, Zone::class);
    }


    public function translations()
    {
        return $this->morphMany(Translation::class, 'translationable');
    }


    public function scopeActive($query)
    {
        return $query->where('status', '=', 1);
    }




}
