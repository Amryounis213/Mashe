<?php

namespace App\Http\Controllers\Api\App;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Foods\FoodCollection;
use App\Models\Favourite;
use App\Models\Restaurant;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    use ApiTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //My Favourite Salons
        $favourites = Favourite::where('user_id', auth('api')->user()->id)->get()->Pluck('food_id')->toArray();
        $rests = Restaurant::whereIn('id', $favourites)->get();
        return new FoodCollection($rests);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'food_id' => 'required|exists:food,id',
        ]);

        if(Favourite::where('user_id', auth('api')->user()->id)->where('food_id', $request->food_id)->exists()){
            Favourite::where('user_id', auth('api')->user()->id)->where('food_id', $request->food_id)->delete();
        }else{
            Favourite::create([
                'user_id' => auth('api')->user()->id,
                'food_id' => $request->food_id,
            ]);
        }
    
        return $this->SuccessApi();
    }

   
    
    
  
}
