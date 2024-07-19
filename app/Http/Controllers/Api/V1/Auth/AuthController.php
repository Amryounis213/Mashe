<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Models\User;
use App\Models\Guest;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use Illuminate\Support\Carbon;
use App\Mail\LoginVerification;
use App\Models\BusinessSetting;
use App\CentralLogics\SMS_module;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Users\UserResource;
use App\Models\Cart;
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
            'country_code' => 'required',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        
        
        
        $data = [
            'country_code' => $request->country_code,
            'phone' => $request->phone,
        ];
        $country_code = $data['country_code'];
        if (strpos($data['country_code'], "+") !== false) {
            $country_code = str_replace("+", "", $data['country_code']);
        }



        
        $customer_verification = BusinessSetting::where('key', 'customer_verification')->first()->value;
        $PhoneNumber = $country_code . '' . $data['phone'];
        $user = User::where('phone', $PhoneNumber)->first();
    
        if ($user) {
            // $token = $user->createToken('RestaurantCustomerAuth')->accessToken;
            if (!$user->status) {
                $errors = [];
                array_push($errors, ['code' => 'auth-003', 'message' => translate('messages.your_account_is_blocked')]);
                return response()->json([
                    'errors' => $errors
                ], 403);
            }


            // if ($customer_verification && !$user->is_phone_verified) {

            // $interval_time = BusinessSetting::where('key', 'otp_interval_time')->first();
            // $otp_interval_time= isset($interval_time) ? $interval_time->value : 60;
            $otp_interval_time = 60; //seconds

            $verification_data = DB::table('phone_verifications')->where('phone', $PhoneNumber)->first();

            if (isset($verification_data) &&  Carbon::parse($verification_data->updated_at)->DiffInSeconds() < $otp_interval_time) {

                $time = $otp_interval_time - Carbon::parse($verification_data->updated_at)->DiffInSeconds();
                $errors = [];
                array_push($errors, ['code' => 'otp', 'message' =>  translate('messages.please_try_again_after_') . $time . ' ' . translate('messages.seconds')]);
                return response()->json([
                    'errors' => $errors
                ], 405);
            }

            // $otp = rand(1000, 9999);
            $otp = rand(1111 , 1111);
            DB::table('phone_verifications')->updateOrInsert(
                ['phone' => $PhoneNumber],
                [
                    'token' => $otp,
                    'otp_hit_count' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            if (config('mail.status') && Helpers::get_mail_status('login_otp_mail_status_user') == '1') {
                Mail::to($user['email'])->send(new LoginVerification($otp, $user->f_name));
            }

            $published_status = 0;
            $payment_published_status = config('get_payment_publish_status');
            if (isset($payment_published_status[0]['is_published'])) {
                $published_status = $payment_published_status[0]['is_published'];
            }

            $PhoneNumber = $request['country_code'] . '' . $request['phone'];
            if ($published_status == 1) {
                $response = SmsGateway::SendSMS($otp, $PhoneNumber);
            } else {
                $response = SmsGateway::SendSMS($otp, $PhoneNumber);
            }



            // if ($response != 'success') {
            //     $errors = [];
            //     array_push($errors, ['code' => 'otp', 'message' => translate('messages.faield_to_send_sms')]);
            //     return response()->json([
            //         'errors' => $errors
            //     ], 405);
            // }
            // }else{

            // }

            if ($user->ref_code == null && isset($user->id)) {
                $ref_code = Helpers::generate_referer_code($user);
                DB::table('users')->where('phone', $user->phone)->update(['ref_code' => $ref_code]);
            }
            return $this->SuccessApi(null, translate('messages.otp_send_successfully'));
        } else {
            $user = User::create([
                'phone' => $PhoneNumber,
            ]);
            $user->ref_code = Helpers::generate_referer_code($user);
            $user->save();

            //create new wallet 
            $user->Wallet()->create();
            $user->CartMemory()->create();
            //generate Otp 
            $otp = rand(1000, 9999);
            $otp = 1111;
            DB::table('phone_verifications')->updateOrInsert(
                ['phone' => $PhoneNumber],
                [
                    'token' => $otp,
                    'otp_hit_count' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            if (config('mail.status') && Helpers::get_mail_status('login_otp_mail_status_user') == '1') {
                Mail::to($user['email'])->send(new LoginVerification($otp, $user->f_name));
            }

            $published_status = 0;
            $payment_published_status = config('get_payment_publish_status');
            if (isset($payment_published_status[0]['is_published'])) {
                $published_status = $payment_published_status[0]['is_published'];
            }
            $PhoneNumber = $request['country_code'] . '' . $request['phone'];
            if ($published_status == 1) {
                $response = SmsGateway::SendSMS($PhoneNumber, $otp);
            } else {
                $response = SmsGateway::SendSMS($PhoneNumber, $otp);
            }
            // $response = 'qq';
            // if ($response != 'success') {
            //     $errors = [];
            //     array_push($errors, ['code' => 'otp', 'message' => translate('messages.faield_to_send_sms')]);
            //     return response()->json([
            //         'errors' => $errors
            //     ], 405);
            // }

            return $this->SuccessApi(null, translate('messages.otp_send_successfully'));
        }
    }

    public function verify_phone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|min:9|max:14',
            'otp' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->FaildResponse($validator, 403);
        }
        $data = DB::table('phone_verifications')->where('phone', $request->phone)->where('token',  $request['otp'])->first();




        if ($data) {
            DB::table('phone_verifications')->where('phone', $request->phone)->where('token',  $request['otp'])->delete();

            $user = User::where('phone', $request->phone)->first();
            $token = $user->createToken('RestaurantCustomerAuth')->accessToken;
            $user->is_phone_verified = 1;
            $user->save();
            return $this->SuccessApi(new UserResource($user->setAttribute('token', $token)), translate('messages.phone_number_varified_successfully'));
        } else {
            // // $otp_hit = BusinessSetting::where('key', 'max_otp_hit')->first();
            // // $max_otp_hit =isset($otp_hit) ? $otp_hit->value : 5 ;
            // $max_otp_hit = 5;

            // // $otp_hit_time = BusinessSetting::where('key', 'max_otp_hit_time')->first();
            // // $max_otp_hit_time =isset($otp_hit_time) ? $otp_hit_time->value : 30 ;

            // $max_otp_hit_time = 60; // seconds
            // $temp_block_time = 600; // seconds

            // $verification_data = DB::table('phone_verifications')->where('phone', $request['phone'])->first();

            // if (isset($verification_data)) {


            //     if ($verification_data->is_blocked == 1) {
            //         $errors = [];
            //         array_push($errors, ['code' => 'otp', 'message' => translate('messages.your_account_is_blocked')]);
            //         return response()->json(['errors' => $errors], 403);
            //     }

            //     if (isset($verification_data->temp_block_time) && Carbon::parse($verification_data->temp_block_time)->DiffInSeconds() <= $temp_block_time) {
            //         $time = $temp_block_time - Carbon::parse($verification_data->temp_block_time)->DiffInSeconds();

            //         $errors = [];
            //         array_push($errors, [
            //             'code' => 'otp_block_time',
            //             'message' => translate('messages.please_try_again_after_') . CarbonInterval::seconds($time)->cascade()->forHumans()
            //         ]);
            //         return response()->json([
            //             'errors' => $errors
            //         ], 405);
            //     }

            //     if ($verification_data->is_temp_blocked == 1 && Carbon::parse($verification_data->updated_at)->DiffInSeconds() >= $max_otp_hit_time) {
            //         DB::table('phone_verifications')->updateOrInsert(
            //             ['phone' => $request['phone']],
            //             [
            //                 'otp_hit_count' => 0,
            //                 'is_temp_blocked' => 0,
            //                 'temp_block_time' => null,
            //                 'created_at' => now(),
            //                 'updated_at' => now(),
            //             ]
            //         );
            //     }

            //     if ($verification_data->is_temp_blocked == 1 && Carbon::parse($verification_data->updated_at)->DiffInSeconds() < $max_otp_hit_time) {
            //         $errors = [];
            //         array_push($errors, ['code' => 'otp', 'message' => translate('messages.please_try_again_after_') . $time . ' ' . translate('messages.seconds')]);
            //         return response()->json([
            //             'errors' => $errors
            //         ], 405);
            //     }

            //     if ($verification_data->otp_hit_count >= $max_otp_hit &&  Carbon::parse($verification_data->updated_at)->DiffInSeconds() < $max_otp_hit_time &&  $verification_data->is_temp_blocked == 0) {

            //         DB::table('phone_verifications')->updateOrInsert(
            //             ['phone' => $request['phone']],
            //             [
            //                 'is_temp_blocked' => 1,
            //                 'temp_block_time' => now(),
            //                 'created_at' => now(),
            //                 'updated_at' => now(),
            //             ]
            //         );
            //         $errors = [];
            //         array_push($errors, ['code' => 'otp_temp_blocked', 'message' => translate('messages.Too_many_attemps')]);
            //         return response()->json([
            //             'errors' => $errors
            //         ], 405);
            //     }


            //     if ($verification_data->otp_hit_count >= $max_otp_hit &&  Carbon::parse($verification_data->updated_at)->DiffInSeconds() < $max_otp_hit_time) {

            //         DB::table('phone_verifications')->updateOrInsert(
            //             ['phone' => $request['phone']],
            //             [
            //                 // 'is_temp_blocked' => 1,
            //                 'created_at' => now(),
            //                 'updated_at' => now(),
            //             ]
            //         );
            //         // $errors = [];
            //         array_push($errors, ['code' => 'otp_warning', 'message' => translate('messages.Too_many_attemps')]);
            //         return response()->json([
            //             'errors' => $errors
            //         ], 405);
            //     }
            // }


            // DB::table('phone_verifications')->updateOrInsert(
            //     ['phone' => $request['phone']],
            //     [
            //         'otp_hit_count' => DB::raw('otp_hit_count + 1'),
            //         'updated_at' => now(),
            //         'temp_block_time' => null,
            //         'token' => 1111,
            //     ]
            // );

            return response()->json([
                'message' => translate('messages.phone_number_and_otp_not_matched')
            ], 404);
        }

        return response()->json([
            'message' => translate('messages.not_found')
        ], 404);
    }





    // public function resend_code(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'phone' => 'required|min:9|max:14',
    //     ]);

    //     if ($validator->fails()) {
    //         return $this->FaildResponse($validator, 403);
    //     }

    //     $otp_interval_time = 60; //seconds

    //     $verification_data = DB::table('phone_verifications')->where('phone', $request['phone'])->first();

    //     if (isset($verification_data) &&  Carbon::parse($verification_data->updated_at)->DiffInSeconds() < $otp_interval_time) {

    //         $time = $otp_interval_time - Carbon::parse($verification_data->updated_at)->DiffInSeconds();
    //         $errors = [];
    //         array_push($errors, ['code' => 'otp', 'message' =>  translate('messages.please_try_again_after_') . $time . ' ' . translate('messages.seconds')]);
    //         return response()->json([
    //             'errors' => $errors
    //         ], 405);
    //     }

    //     $otp = rand(1000, 9999);
    //     DB::table('phone_verifications')->updateOrInsert(
    //         ['phone' => $request['phone']],
    //         [
    //             'token' => $otp,
    //             'otp_hit_count' => 0,
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]
    //     );



    //     if ($data) {
    //         DB::table('phone_verifications')->where('phone', $request->phone)->where('token',  $request['otp'])->delete();
    //         $user = User::where('phone', $request->phone)->first();

    //         $user->save();
    //         return $this->SuccessApi(new UserResource($user->setAttribute('token', $token)), translate('messages.phone_number_varified_successfully'));
    //     } else {

    //         return response()->json([
    //             'message' => translate('messages.phone_number_and_otp_not_matched')
    //         ], 404);
    //     }

    //     return response()->json([
    //         'message' => translate('messages.not_found')
    //     ], 404);
    // }
}
