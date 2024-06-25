<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ParentCategory extends Model
{
    use HasFactory; 
    
      /**
     * Get the parent commentable model (restaurant or market).
     */
    public function parentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function translations()
    {
        return $this->morphMany(Translation::class, 'translationable');
    }


    public function Foods()
    {
        return $this->hasMany(Food::class , 'category_id');
    }



    public function childes()
    {
        return $this->morphMany(ParentCategory::class, 'parentable');
    }

    public function parent()
    {
        return $this->morphTo(ParentCategory::class, 'parent_id');
    }


    public function scopeActive($query)
    {
        return $query->where('status', '=', 1);
    }

}
