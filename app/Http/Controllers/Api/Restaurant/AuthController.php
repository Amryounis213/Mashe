<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Models\User;
use App\Models\Guest;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use Illuminate\Support\Carbon;
use App\Mail\LoginVerification;
use App\Models\BusinessSetting;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Users\UserResource;
use App\Models\Restaurant;
use App\Traits\ApiTrait;
use App\Traits\SmsGateway;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    use ApiTrait, SmsGateway;
    public function login(Request $request)
    {
      
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:restaurants,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        $data = [
            'username' => $request->email,
        ];

        // $customer_verification = BusinessSetting::where('key', 'customer_verification')->first()->value;
     
        $restaurant = Restaurant::where('email', $data['username'])->first();

        if ($restaurant) {
            $token = $restaurant->createToken('RestaurantAuth')->accessToken;
            
            if (!$restaurant->status) {
                $errors = [];
                array_push($errors, ['code' => 'auth-003', 'message' => translate('messages.your_account_is_blocked')]);
                return response()->json([
                    'errors' => $errors
                ], 403);
            }

            return $this->SuccessApi($token, translate('messages.login_successfully'));
        } 
    }

    // public function verify_phone(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'phone' => 'required|min:9|max:14',
    //         'otp' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return $this->FaildResponse($validator, 403);
    //     }
    //     $data = DB::table('phone_verifications')->where('phone', $request->phone)->where('token',  $request['otp'])->first();




    //     if ($data) {
    //         DB::table('phone_verifications')->where('phone', $request->phone)->where('token',  $request['otp'])->delete();

    //         $user = User::where('phone', $request->phone)->first();
    //         $token = $user->createToken('RestaurantCustomerAuth')->accessToken;
    //         $user->is_phone_verified = 1;
    //         $user->save();
    //         return $this->SuccessApi(new UserResource($user->setAttribute('token', $token)), translate('messages.phone_number_varified_successfully'));
    //     } else {
    //         // $otp_hit = BusinessSetting::where('key', 'max_otp_hit')->first();
    //         // $max_otp_hit =isset($otp_hit) ? $otp_hit->value : 5 ;
    //         $max_otp_hit = 5;

    //         // $otp_hit_time = BusinessSetting::where('key', 'max_otp_hit_time')->first();
    //         // $max_otp_hit_time =isset($otp_hit_time) ? $otp_hit_time->value : 30 ;

    //         $max_otp_hit_time = 60; // seconds
    //         $temp_block_time = 600; // seconds

    //         $verification_data = DB::table('phone_verifications')->where('phone', $request['phone'])->first();

    //         if (isset($verification_data)) {


    //             if ($verification_data->is_blocked == 1) {
    //                 $errors = [];
    //                 array_push($errors, ['code' => 'otp', 'message' => translate('messages.your_account_is_blocked')]);
    //                 return response()->json(['errors' => $errors], 403);
    //             }



    //             if (isset($verification_data->temp_block_time) && Carbon::parse($verification_data->temp_block_time)->DiffInSeconds() <= $temp_block_time) {
    //                 $time = $temp_block_time - Carbon::parse($verification_data->temp_block_time)->DiffInSeconds();

    //                 $errors = [];
    //                 array_push($errors, [
    //                     'code' => 'otp_block_time',
    //                     'message' => translate('messages.please_try_again_after_') . CarbonInterval::seconds($time)->cascade()->forHumans()
    //                 ]);
    //                 return response()->json([
    //                     'errors' => $errors
    //                 ], 405);
    //             }

    //             if ($verification_data->is_temp_blocked == 1 && Carbon::parse($verification_data->updated_at)->DiffInSeconds() >= $max_otp_hit_time) {
    //                 DB::table('phone_verifications')->updateOrInsert(
    //                     ['phone' => $request['phone']],
    //                     [
    //                         'otp_hit_count' => 0,
    //                         'is_temp_blocked' => 0,
    //                         'temp_block_time' => null,
    //                         'created_at' => now(),
    //                         'updated_at' => now(),
    //                     ]
    //                 );
    //             }

    //             if ($verification_data->is_temp_blocked == 1 && Carbon::parse($verification_data->updated_at)->DiffInSeconds() < $max_otp_hit_time) {
    //                 $errors = [];
    //                 array_push($errors, ['code' => 'otp', 'message' => translate('messages.please_try_again_after_') . $time . ' ' . translate('messages.seconds')]);
    //                 return response()->json([
    //                     'errors' => $errors
    //                 ], 405);
    //             }

    //             if ($verification_data->otp_hit_count >= $max_otp_hit &&  Carbon::parse($verification_data->updated_at)->DiffInSeconds() < $max_otp_hit_time &&  $verification_data->is_temp_blocked == 0) {

    //                 DB::table('phone_verifications')->updateOrInsert(
    //                     ['phone' => $request['phone']],
    //                     [
    //                         'is_temp_blocked' => 1,
    //                         'temp_block_time' => now(),
    //                         'created_at' => now(),
    //                         'updated_at' => now(),
    //                     ]
    //                 );
    //                 $errors = [];
    //                 array_push($errors, ['code' => 'otp_temp_blocked', 'message' => translate('messages.Too_many_attemps')]);
    //                 return response()->json([
    //                     'errors' => $errors
    //                 ], 405);
    //             }


    //             if ($verification_data->otp_hit_count >= $max_otp_hit &&  Carbon::parse($verification_data->updated_at)->DiffInSeconds() < $max_otp_hit_time) {

    //                 DB::table('phone_verifications')->updateOrInsert(
    //                     ['phone' => $request['phone']],
    //                     [
    //                         // 'is_temp_blocked' => 1,
    //                         'created_at' => now(),
    //                         'updated_at' => now(),
    //                     ]
    //                 );
    //                 // $errors = [];
    //                 array_push($errors, ['code' => 'otp_warning', 'message' => translate('messages.Too_many_attemps')]);
    //                 return response()->json([
    //                     'errors' => $errors
    //                 ], 405);
    //             }
    //         }


    //         DB::table('phone_verifications')->updateOrInsert(
    //             ['phone' => $request['phone']],
    //             [
    //                 'otp_hit_count' => DB::raw('otp_hit_count + 1'),
    //                 'updated_at' => now(),
    //                 'temp_block_time' => null,
    //                 'token' => 1111,
    //             ]
    //         );

    //         return response()->json([
    //             'message' => translate('messages.phone_number_and_otp_not_matched')
    //         ], 404);
    //     }

    //     return response()->json([
    //         'message' => translate('messages.not_found')
    //     ], 404);
    // }
}
