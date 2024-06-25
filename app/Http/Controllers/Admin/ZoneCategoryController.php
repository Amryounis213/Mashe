<?php

namespace App\Http\Controllers\Admin;

use App\Models\ZoneCategory;
use App\Models\Translation;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use App\Exports\CategoryExport;
use Illuminate\Support\Facades\DB;
use App\CentralLogics\CategoryLogic;
use App\Http\Controllers\Controller;
use App\Models\Zone;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Rap2hpoutre\FastExcel\FastExcel;

class ZoneCategoryController extends Controller
{

    /**
     * 
     * Categories IN CUSTOM ZONE
     * 
     */
    public function categories($id)
    {

        $zone = Zone::findorfail($id);
       
        $RestCategories = ZoneCategory::where('zone_id' , $zone->id)->where('is_market_category' , 0)->get();
        $MarketCategories = ZoneCategory::where('zone_id' , $zone->id)->where('is_market_category' , 1)->get();
        return view('admin-views.zone.categories' , compact( 'RestCategories' ,'MarketCategories' , 'zone'));

    }
    public function create_category_page($zone_id)
    {
        return view('admin-views.zone.add-new-categoy' , compact('zone_id'));
    }
    public function add_new_category(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'image' => 'required',
            'zone_id' => 'required|exists:zones,id',
           
        ], [
            'name.required' => translate('messages.name_is_required'),
            // 'additional_documents.max' => translate('You_can_chose_max_5_files_only'),
        ]);

    
        $category = new ZoneCategory();
        $category->name = $request->name[array_search('default', $request->lang)];;
        $category->image = $request->has('image') ? Helpers::upload(dir:'category/',format: 'png',image: $request->file('image')) : 'def.png';
        $category->zone_id = $request->zone_id ;
        $category->is_market_category = $request->status ;
        $category->save();


        $default_lang = str_replace('_', '-', app()->getLocale());
        $data = [];
        foreach ($request->lang as $index => $key) {
            if($default_lang == $key && !($request->name[$index])){
                if ($key != 'default') {
                    array_push($data, array(
                        'translationable_type' => 'App\Models\ZoneCategory',
                        'translationable_id' => $category->id,
                        'locale' => $key,
                        'key' => 'name',
                        'value' => $category->name,
                    ));
                }
            }else{
                if ($request->name[$index] && $key != 'default') {
                    array_push($data, array(
                        'translationable_type' => 'App\Models\ZoneCategory',
                        'translationable_id' => $category->id,
                        'locale' => $key,
                        'key' => 'name',
                        'value' => $request->name[$index],
                    ));
                }
            }
        }

        Translation::insert($data);
        Toastr::success(translate('messages.menus') . translate('messages.added_successfully'));
        return redirect()->route('admin.zone.categories' , $request->zone_id);
    } 


    public function destroy($id)
    {
        $zone = ZoneCategory::findorfail($id);
        $zone->delete();
        return back();
    }


    public function status(Request $request)
    {
        $id = $request->get('id');
        $info = ZoneCategory::find($id);
        return Controller::updateModelStatus($info);
    }

    public function Marketstatus(Request $request)
    {
        $id = $request->get('id');
        $info = ZoneCategory::find($id);
        return self::updateMarketModelStatus($info);
    }

    function updateMarketModelStatus($info): \Illuminate\Http\JsonResponse
    {
        if ($info) {
            $is_market_category = $info->is_market_category;
            if ($is_market_category == 0) {
                $info->update(['is_market_category' => 1]);
            } else {
                $info->update(['is_market_category' => 0]);
            }
            return response()->json(['status' => 'success', 'message' => trans('تم تعديل الحالة بنجاح.'), 'type' => 'no']);
        } else {
            return response()->json(['status' => 'error', 'message' => trans('لم يتم العثور على البيانات!')]);
        }
    }

    



    
  
}
