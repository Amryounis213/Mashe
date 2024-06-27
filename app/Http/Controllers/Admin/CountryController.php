<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Incentive;
use App\Exports\CountryExport;
use App\Models\Translation;
use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Country;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Validator;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Objects\Polygon;
use MatanYadaev\EloquentSpatial\Objects\LineString;

class CountryController extends Controller
{
    public function index(Request $request)
    {

        
        $key = explode(' ', $request['search'] ?? null);
        $countries = Country::withCount(['restaurants', 'deliverymen'])
            ->when(isset($key), function ($query) use ($key) {
                $query->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->orWhere('name', 'like', "%{$value}%");
                    }
                });
            })
            ->latest()->paginate(config('default_pagination'));


        return view('admin-views.country.index', compact('countries'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:countries|max:191',
            'code' => 'required|unique:countries|max:191',
            'currency' => 'nullable|unique:countries|max:191',
            'coordinates' => 'nullable',
        ]);
        // return $request ;
        if ($request->name[array_search('default', $request->lang)] == '') {
            $validator->getMessageBag()->add('title', translate('messages.default_Business_Country_name_is_required'));
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }
        $value = $request->coordinates;
        foreach(explode('),(',trim($value,'()')) as $index=>$single_array){
            if($index == 0)
            {
                $lastcord = explode(',',$single_array);
            }
            $coords = explode(',',$single_array);
            $polygon[] = new Point($coords[0], $coords[1]);
        }
        $Country_id=Country::all()->count() + 1;
        // $polygon[] = new Point($lastcord[0], $lastcord[1]);

        $country = new Country();
        $country->name = $request->name[array_search('default', $request->lang)];
        $country->coordinates = new Polygon([new LineString($polygon)]);
        $country->code = $request->code ;
        $country->currency = $request->currency ;
        $country->save();
        $default_lang = str_replace('_', '-', app()->getLocale());
        $data = [];
        foreach ($request->lang as $index => $key) {
            if ($default_lang == $key && !($request->name[$index])) {
                if ($key != 'default') {
                    array_push($data, array(
                        'translationable_type'  => 'App\Models\Country',
                        'translationable_id'    => $country->id,
                        'locale'                => $key,
                        'key'                   => 'name',
                        'value'                 => $country->name,
                    ));
                }
            } else {
                if ($request->name[$index] && $key != 'default') {
                    array_push($data, array(
                        'translationable_type'  => 'App\Models\Country',
                        'translationable_id'    => $country->id,
                        'locale'                => $key,
                        'key'                   => 'name',
                        'value'                 => $request->name[$index],
                    ));
                }
            }
        }

        if (count($data)) {
            Translation::insert($data);
        }
        $new_data = 1;
        Toastr::success(translate('messages.country_added_successfully'));
        $countries = Country::withCount(['restaurants', 'deliverymen'])->latest()->paginate(config('default_pagination'));
        return back();
    }

    public function edit($id)
    {
        $country = Country::findOrFail($id);
        return view('admin-views.country.edit', compact(['country']));
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:191|unique:countries,name,' . $id,
        ]);

        if ($request->name[array_search('default', $request->lang)] == '') {
            Toastr::error(translate('default_Business_Country_name_is_required'));
            return back();
        }

        $country = Country::findOrFail($id);
        $country->name = $request->name[array_search('default', $request->lang)];
        $country->save();
        $default_lang = str_replace('_', '-', app()->getLocale());
        foreach ($request->lang as $index => $key) {
            if ($default_lang == $key && !($request->name[$index])) {
                if ($key != 'default') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type' => 'App\Models\Country',
                            'translationable_id' => $country->id,
                            'locale' => $key,
                            'key' => 'name'
                        ],
                        ['value' => $country->name]
                    );
                }
            } else {
                if ($request->name[$index] && $key != 'default') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type' => 'App\Models\Country',
                            'translationable_id' => $country->id,
                            'locale' => $key,
                            'key' => 'name'
                        ],
                        ['value' => $request->name[$index]]
                    );
                }
            }
        }


        Toastr::success(translate('messages.country_updated_successfully'));
        return redirect()->route('admin.country.add');
    }



    public function destroy($id)
    {
        // return $id;
        $country = Country::findorfail($id);
        $country->delete();
        Toastr::success(translate('messages.country_deleted_successfully'));
        return back();
    }

    public function status(Request $request)
    {

        $country = Country::findOrFail($request->id);
        $country->status = $request->status;
        $country->save();
        Toastr::success(translate('messages.Country_status_updated'));
        return back();
    }

    // public function search(Request $request){
    //     $key = explode(' ', $request['search']);
    //     $Countrys=Country::withCount(['restaurants','deliverymen'])
    //     ->where(function ($q) use ($key) {
    //         foreach ($key as $value) {
    //             $q->orWhere('name', 'like', "%{$value}%");
    //         }
    //     })->limit(50)->get();
    //     return response()->json([
    //         'view'=>view('admin-views.country.partials._table',compact('Countrys'))->render(),
    //         'total'=>$Countrys->count()
    //     ]);
    // }



    public function Country_filter($id)
    {
        if ($id == 'all') {
            if (session()->has('Country_id')) {
                session()->forget('Country_id');
            }
        } else {
            session()->put('Country_id', $id);
        }

        return back();
    }

    public function get_all_Country_cordinates($id = 0)
    {
        $Countrys = Country::where('id', '<>', $id)->active()->get();
        $data = [];
        foreach ($Countrys as $country) {
            $area = json_decode($country->coordinates[0]->toJson(), true);
            $data[] = Helpers::format_coordiantes($area['coordinates']);
        }
        return response()->json($data, 200);
    }

    public function export_countries(Request $request, $type)
    {

        $key = explode(' ', $request['search']);
        $collection = Country::withCount(['restaurants', 'deliverymen'])
            ->when(isset($key), function ($q) use ($key) {
                $q->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->orWhere('name', 'like', "%{$value}%");
                    }
                });
            })
            ->get();
        $data = [
            'data' => $collection,
            'search' => $request['search'] ?? null,
        ];
        if ($type == 'csv') {
            return Excel::download(new CountryExport($data), 'Country.csv');
        }
        return Excel::download(new CountryExport($data), 'Country.xlsx');
    }

    public function store_incentive(Request $request, $Country_id)
    {
        $request->validate([
            'earning' => 'required|unique:incentives|numeric|between:1,999999999999.99',
            'incentive' => 'required|numeric|between:1,999999999999.99'
        ], [
            'earning.unique' => translate('This_earning_amount_already_exists')
        ]);

        $incentive = new Incentive();
        $incentive->earning = $request->earning;
        $incentive->incentive = $request->incentive;
        $incentive->Country_id = $Country_id;
        $incentive->save();
        Toastr::success(translate('messages.incentive_inserted_successfully'));
        return back();
    }

    public function destroy_incentive(Request $request, $id)
    {
        $incentive = Incentive::findOrFail($id);
        $incentive?->delete();
        Toastr::success(translate('messages.incentive_deleted_successfully'));
        return back();
    }
}
