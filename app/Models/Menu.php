<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Menu extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**Relation */
    public function Food()
    {
        return $this->hasMany(Food::class , 'menu_id');
    }

     /**
     * Get the parent commentable model (post or video).
     */
    public function parentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function translations()
    {
        return $this->morphMany(Translation::class, 'translationable');
    }

}
