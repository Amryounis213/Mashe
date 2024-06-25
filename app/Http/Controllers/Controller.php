<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function updateModelStatus($info): \Illuminate\Http\JsonResponse
    {
        if ($info) {
            $status = $info->status;
            if ($status == 0) {
                $info->update(['status' => 1]);
            } else {
                $info->update(['status' => 0]);
            }
            return response()->json(['status' => 'success', 'message' => trans('تم تعديل الحالة بنجاح.'), 'type' => 'no']);
        } else {
            return response()->json(['status' => 'error', 'message' => trans('لم يتم العثور على البيانات!')]);
        }
    }
}
