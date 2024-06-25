<?php

namespace App\Http\Controllers\Api\App;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Users\UserResource;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\Zone;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Point;

class ProfileController extends Controller
{
    use ApiTrait ;
    public function update_image(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'nullable|max:2048',
        ]);


        $image = $request->file('image');
        if ($request->has('image')) {
            $imageName = Helpers::update(dir:'profile/',old_image: $request?->user()?->image, format:'png', image:$request->file('image'));
        } else {
            $imageName = $request?->user()?->image;
        }

        $userDetails = [
            'image' => $imageName,
        ];
      
        return response()->json(['message' => translate('messages.successfully_updated')], 200);
    }

   
    public function update_profile(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'f_name' => 'required',
            'l_name' => 'required',
            'email' => 'nullable|unique:users,email,'.$request?->user()?->id,
            'image' => 'nullable|max:2048',
            'password' => ['nullable', Password::min(8)],

        ], [
            'f_name.required' => 'First name is required!',
            'l_name.required' => 'Last name is required!',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $image = $request->file('image');

        if ($request->has('image')) {
            $imageName = Helpers::update(dir:'profile/',old_image: $request?->user()?->image, format:'png', image:$request->file('image'));
        } else {
            $imageName = $request?->user()?->image;
        }

        if ($request['password'] != null && strlen($request['password']) > 5) {
            $pass = bcrypt($request['password']);
        } else {
            $pass = $request?->user()?->password;
        }

        $userDetails = [
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'email' => $request->email ?? auth('api')->user()->email,
            'image' => $imageName,
            'password' => $pass,
            'updated_at' => now()
        ];

       User::where(['id' => auth('api')->id() ])->update($userDetails);
        if($request?->user()?->userinfo) {
            UserInfo::where(['user_id' => auth('api')->id() ])->update([
                'f_name' => $request->f_name,
                'l_name' => $request->l_name,
                'email' => $request->email,
                'image' => $imageName
            ]);
        }

        $token = request()->header('Authorization');
        $user = User::find(auth('api')->id());
        return $this->SuccessApi(new UserResource($user->setAttribute('token', str_replace('Bearer ' , '' , $token))) , translate('messages.successfully_updated'));
    }

    public function profile(Request $request)
    {
        $token = request()->header('Authorization');
        $user = User::find(auth('api')->id());
        return $this->SuccessApi(new UserResource($user->setAttribute('token', str_replace('Bearer ' , '' , $token))) , translate('messages.profile'));
    }
    

    public function update_interest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'interest' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $userDetails = [
            'interest' => json_encode($request->interest),
        ];

        User::where(['id' => $request?->user()?->id])->update($userDetails);

        return response()->json(['message' => translate('messages.interest_updated_successfully')], 200);
    }

    
    public function update_cm_firebase_token(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cm_firebase_token' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        DB::table('users')->where('id',$request?->user()?->id)->update([
            'cm_firebase_token'=>$request['cm_firebase_token']
        ]);

        return response()->json(['message' => translate('messages.updated_successfully')], 200);
    }

    public function get_suggested_food(Request $request)
    {
        if (!$request->hasHeader('zoneId')) {
            $errors = [];
            array_push($errors, ['code' => 'zoneId', 'message' => 'Zone id is required!']);
            return response()->json([
                'errors' => $errors
            ], 403);
        }


        $zone_id= json_decode($request->header('zoneId'), true);

        $interest = $request?->user()?->interest;
        $interest = isset($interest) ? json_decode($interest):null;
        // return response()->json($interest, 200);

        $products =  Food::active()->whereHas('restaurant', function($q)use($zone_id){
            $q->whereIn('zone_id', $zone_id);
        })
        ->when(isset($interest), function($q)use($interest){
            return $q->whereIn('category_id',$interest);
        })
        ->when($interest == null, function($q){
            return $q->popular();
        })->limit(5)->get();
        $products = Helpers::product_data_formatting($products, true, false, app()->getLocale());
        return response()->json($products, 200);
    }

    public function update_zone(Request $request)
    {
        if (!$request->hasHeader('zoneId') && is_numeric($request->header('zoneId'))) {
            $errors = [];
            array_push($errors, ['code' => 'zoneId', 'message' => translate('messages.zone_id_required')]);
            return response()->json([
                'errors' => $errors
            ], 403);
        }

        $customer = $request->user();
        $customer->zone_id = (integer)json_decode($request->header('zoneId'), true)[0];
        $customer->save();
        return response()->json([], 200);
    }

    public function remove_account(Request $request)
    {
        $user = $request->user();

        if(Order::where('user_id', $user->id)->where('is_guest',0)->whereIn('order_status', ['pending','accepted','confirmed','processing','handover','picked_up'])->count())
        {
            return response()->json(['errors'=>[['code'=>'on-going', 'message'=>translate('messages.user_account_delete_warning')]]],403);
        }
        $request?->user()?->token()->revoke();
        if($user?->userinfo){
            $user?->userinfo?->delete();
        }
        $user->delete();
        return response()->json([]);
    }
}
