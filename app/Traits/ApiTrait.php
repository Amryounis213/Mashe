<?php 

namespace App\Traits ;

use App\Models\Sector;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
trait ApiTrait {

    // public $msg = 'SUCCESS';
    
    public function SuccessApi($user = null  , $msg = 'SUCCESS'  , $code = 200)
    {
        $data = [
            'status' => true ,
            'code' => $code ,
            'message' => $msg ,
            'data' => $user ,
            
        ];
        return response()->json($data , $code);
    }
   

    public function FailedApi($msg , $code = 422)
    {
        return Response()->Json([
            'status' => false,
            'code' => $code,
            'message' => $msg ,
            'data' => '' ,
        ], $code);

    }


    function FailedValidationResponse($errors): JsonResponse
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'code' => 422,
            'message' => $errors->first(),
            'item' => $errors->jsonSerialize(),
        ], 422));
    }


}