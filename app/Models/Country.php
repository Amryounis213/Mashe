<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Objects\Polygon;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;

class Country extends Model
{
    use HasFactory;
    use HasSpatial;
    protected $casts = [
        'id'=>'integer',
        'coordinates' => Polygon::class,
    ];


    public function scopeContains($query,$abc){
        return $query->whereRaw("ST_Distance_Sphere(coordinates, POINT({$abc}))");
    }

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
