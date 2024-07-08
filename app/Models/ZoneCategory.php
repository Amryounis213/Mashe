<?php

namespace App\Models;

use App\Scopes\ZoneScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ZoneCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function translations()
    {
        return $this->morphMany(Translation::class, 'translationable');
    }

    public function Zone()
    {
        return $this->belongsTo(Zone::class);
    }

    protected static function booted()
    {
        static::addGlobalScope(new ZoneScope);
        static::addGlobalScope('translate', function (Builder $builder) {
            $builder->with(['translations' => function ($query) {
                return $query->where('locale', app()->getLocale());
            }]);
        });
    }

    // Accessor for Name
    public function getNameAttribute()
    {
       
        $locale = request()->header('X-localization', app()->getLocale());
        $translation = $this->translations->firstWhere('locale', $locale);
        // return $translation;
        return $translation ? $translation->value : $this->attributes['name'];
    }


    public function scopeForMarkets($query)
    {
        return $query->where('is_market_category', 1);
    }

    public function scopeForRestaurants($query)
    {
        return $query->where('is_market_category', 0);
    }

}
