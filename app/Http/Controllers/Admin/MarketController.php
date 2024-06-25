<?php

namespace App\Http\Controllers\Admin;

use App\Exports\DisbursementHistoryExport;
use App\Models\DataSetting;
use App\Models\DisbursementDetails;
use App\Models\Food;
use App\Models\Tag;
use App\Models\Zone;
use App\Models\AddOn;
use App\Models\Order;
use App\Models\MarketVendor as Vendor;
use App\Models\Cuisine;
use App\Models\Message;
use App\Models\UserInfo;
use App\Models\Market;
use App\Models\Translation;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use Illuminate\Support\Carbon;
use App\Models\BusinessSetting;
use App\Models\WithdrawRequest;
use App\Scopes\marketScope;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\OrderTransaction;
use App\Models\marketConfig;
use App\Models\marketWallet;
use App\Models\AccountTransaction;
use App\Models\marketSchedule;
use Illuminate\Support\Facades\DB;
use App\Models\SubscriptionPackage;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Exports\marketListExport;
use App\CentralLogics\marketLogic;
use App\Models\marketSubscription;
use App\Models\SubscriptionTransaction;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use MatanYadaev\EloquentSpatial\Objects\Point;
use App\Exports\RestauranrWiseFoodReviewExport;
use App\Exports\marketWiseCashCollectionExport;
use App\Exports\marketWithdrawTransactionExport;
use App\Exports\marketWiseWithdrawTransactionExport;
use App\Exports\marketWiseWithdrawOrderTransactionExport;
use App\Models\Menu;
use App\Models\ParentCategory;

class MarketController extends Controller
{
    public function index()
    {

        $page_data =   DataSetting::Where('type', 'market')->where('key', 'market_page_data')->first()?->value;
        $page_data =  $page_data ? json_decode($page_data, true)  : [];
        return view('admin-views.market.index', compact('page_data'));
    }

    public function store(Request $request)
    {

        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'f_name' => 'required|max:100',
            'l_name' => 'nullable|max:100',
            'name' => 'required|max:191',
            'address' => 'required|max:1000',
            'latitude' => 'required|numeric|min:-90|max:90',
            'longitude' => 'required|numeric|min:-180|max:180',
            'email' => 'required|unique:market_vendors',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:20|unique:market_vendors',
            'minimum_delivery_time' => 'required',
            'maximum_delivery_time' => 'required|gt:minimum_delivery_time',
            'password' => ['required', Password::min(8)->mixedCase()->letters()->numbers()->symbols()->uncompromised()],
            // 'additional_documents' => 'nullable|array|max:5',
            // 'additional_documents.*' => 'nullable|max:2048',
            'zone_id' => 'required',
            'logo' => 'required|max:2048',
            'cover_photo' => 'required|max:2048',
            'tax' => 'required',
            'delivery_time_type' => 'required',
        ], [
            'f_name.required' => translate('messages.first_name_is_required'),
            // 'additional_documents.max' => translate('You_can_chose_max_5_files_only'),
        ]);

        $cuisine_ids = [];
        $cuisine_ids = $request->cuisine_ids;
        if ($request->zone_id) {
            $zone = Zone::query()
                ->whereContains('coordinates', new Point($request->latitude, $request->longitude, POINT_SRID))->where('id', $request->zone_id)->first();
            if (!$zone) {
                $validator->getMessageBag()->add('latitude', translate('messages.coordinates_out_of_zone'));
                return back()->withErrors($validator)
                    ->withInput();
            }
        }

        if ($request->name[array_search('default', $request->lang)] == '') {
            $validator->getMessageBag()->add('address', translate('messages.default_market_name_is_required'));
            return back()->withErrors($validator)->withInput();
        }
        if ($request->address[array_search('default', $request->lang)] == '') {
            $validator->getMessageBag()->add('address', translate('messages.default_market_address_is_required'));
            return back()->withErrors($validator)->withInput();
        }

        if ($request->delivery_time_type == 'min') {
            $minimum_delivery_time = (int) $request->input('minimum_delivery_time');
            if ($minimum_delivery_time < 10) {
                $validator->getMessageBag()->add('minimum_delivery_time', translate('messages.minimum_delivery_time_should_be_more_than_10_min'));
                return back()->withErrors($validator)->withInput();
            }
        }
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }


        $tag_ids = [];
        if ($request->tags != null) {
            $tags = explode(",", $request->tags);
        }
        if (isset($tags)) {
            foreach ($tags as $key => $value) {
                $tag = Tag::firstOrNew(
                    ['tag' => $value]
                );
                $tag->save();
                array_push($tag_ids, $tag->id);
            }
        }



        $vendor = new Vendor();
        $vendor->f_name = $request->f_name;
        $vendor->l_name = $request->l_name;
        $vendor->email = $request->email;
        $vendor->phone = $request->phone;
        $vendor->password = bcrypt($request->password);
        $vendor->save();

        $market = new Market;
        $market->name = $request->name[array_search('default', $request->lang)];
        $market->phone = $request->phone;
        $market->email = $request->email;
        $market->logo = Helpers::upload(dir: 'market/', format: 'png',  image: $request->file('logo'));
        $market->cover_photo = Helpers::upload(dir: 'market/cover/',  format: 'png', image: $request->file('cover_photo'));
        $market->address = $request->address[array_search('default', $request->lang)];
        $market->latitude = $request->latitude;
        $market->longitude = $request->longitude;
        $market->vendor_id = $vendor->id;
        $market->zone_id = $request->zone_id;
        $market->tax = $request->tax;
        $market->market_model = 'none';
        $market->delivery_time = $request->minimum_delivery_time . '-' . $request->maximum_delivery_time . '-' . $request->delivery_time_type;

        if (isset($request->additional_data)  && count($request->additional_data) > 0) {
            $market->additional_data = json_encode($request->additional_data);
        }

        $additional_documents = [];
        if ($request->additional_documents) {
            foreach ($request->additional_documents as $key => $data) {
                $additional = [];
                foreach ($data as $file) {
                    if (is_file($file)) {
                        $file_name = Helpers::upload('additional_documents/', $file->getClientOriginalExtension(), $file);
                        $additional[] = $file_name;
                    }
                    $additional_documents[$key] = $additional;
                }
            }
            $market->additional_documents = json_encode($additional_documents);
        }

        $market->save();
        $market->tags()->sync($tag_ids);


        $default_lang = str_replace('_', '-', app()->getLocale());
        $data = [];
        foreach ($request->lang as $index => $key) {
            if ($default_lang == $key && !($request->name[$index])) {
                if ($key != 'default') {
                    array_push($data, array(
                        'translationable_type' => 'App\Models\Market',
                        'translationable_id' => $market->id,
                        'locale' => $key,
                        'key' => 'name',
                        'value' => $market->name,
                    ));
                }
            } else {
                if ($request->name[$index] && $key != 'default') {
                    array_push($data, array(
                        'translationable_type' => 'App\Models\Market',
                        'translationable_id' => $market->id,
                        'locale' => $key,
                        'key' => 'name',
                        'value' => $request->name[$index],
                    ));
                }
            }
            if ($default_lang == $key && !($request->address[$index])) {
                if ($key != 'default') {
                    array_push($data, array(
                        'translationable_type' => 'App\Models\Market',
                        'translationable_id' => $market->id,
                        'locale' => $key,
                        'key' => 'address',
                        'value' => $market->address,
                    ));
                }
            } else {
                if ($request->address[$index] && $key != 'default') {
                    array_push($data, array(
                        'translationable_type' => 'App\Models\Market',
                        'translationable_id' => $market->id,
                        'locale' => $key,
                        'key' => 'address',
                        'value' => $request->address[$index],
                    ));
                }
            }
        }
        Translation::insert($data);
        Toastr::success(translate('messages.market') . translate('messages.added_successfully'));
        return redirect('admin/market/list');
    }

    public function edit($id)
    {
        if (env('APP_MODE') == 'demo' && $id == 2) {
            Toastr::warning(translate('messages.you_can_not_edit_this_market_please_add_a_new_market_to_edit'));
            return back();
        }
        $market = Market::withoutGlobalScope('translate')->with('translations')->find($id);
        return view('admin-views.market.edit', compact('market'));
    }


    public function update(Request $request, Market $market)
    {
        $validator = Validator::make($request->all(), [
            'f_name' => 'required|max:100',
            'l_name' => 'nullable|max:100',
            'name' => 'required|max:191',
            'email' => 'required|unique:market_vendors,email,' . $market?->market?->id,
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:20|unique:market_vendors,phone,' . $market?->market?->id,
            'zone_id' => 'required',
            'latitude' => 'required|min:-90|max:90',
            'longitude' => 'required|min:-180|max:180',
            'tax' => 'required',
            'password' => ['nullable', Password::min(8)->mixedCase()->letters()->numbers()->symbols()->uncompromised()],
            'minimum_delivery_time' => 'required',
            'maximum_delivery_time' => 'required|gt:minimum_delivery_time',
            'logo' => 'nullable|max:2048',
            'cover_photo' => 'nullable|max:2048',
            'delivery_time_type' => 'required',
        ], [
            'f_name.required' => translate('messages.first_name_is_required')
        ]);


        if ($request->name[array_search('default', $request->lang)] == '') {
            $validator->getMessageBag()->add('address', translate('messages.default_market_name_is_required'));
            return back()->withErrors($validator)->withInput();
        }
        if ($request->address[array_search('default', $request->lang)] == '') {
            $validator->getMessageBag()->add('address', translate('messages.default_market_address_is_required'));
            return back()->withErrors($validator)->withInput();
        }
        if ($request?->zone_id) {
            $zone = Zone::query()
                ->whereContains('coordinates', new Point($request->latitude, $request->longitude, POINT_SRID))
                ->where('id', $request->zone_id)
                ->first();

            if (!$zone) {
                $validator->getMessageBag()->add('latitude', translate('messages.coordinates_out_of_zone'));
                return back()->withErrors($validator)
                    ->withInput();
            }
        }


        if ($request->delivery_time_type == 'min') {
            $minimum_delivery_time = (int) $request->input('minimum_delivery_time');
            if ($minimum_delivery_time < 10) {
                $validator->getMessageBag()->add('minimum_delivery_time', translate('messages.minimum_delivery_time_should_be_more_than_10_min'));
                return back()->withErrors($validator)->withInput();
            }
        }
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $tag_ids = [];
        if ($request->tags != null) {
            $tags = explode(",", $request->tags);
        }
        if (isset($tags)) {
            foreach ($tags as $key => $value) {
                $tag = Tag::firstOrNew(
                    ['tag' => $value]
                );
                $tag->save();
                array_push($tag_ids, $tag->id);
            }
        }


        $market = Vendor::findOrFail($market?->market?->id);
        $market->f_name = $request->f_name;
        $market->l_name = $request->l_name;
        $market->email = $request->email;
        $market->phone = $request->phone;
        $market->password = strlen($request->password) > 1 ? bcrypt($request->password) : $market->market->password;
        $market->save();

        // $cuisine_ids = [];
        // $cuisine_ids = $request->cuisine_ids;

        $slug = Str::slug($request->name[array_search('default', $request->lang)]);
        $market->slug = $market->slug ? $market->slug : "{$slug}{$market->id}";

        $market->email = $request->email;
        $market->phone = $request->phone;
        $market->logo = $request->has('logo') ? Helpers::update(dir: 'market/', old_image: $market->logo, format: 'png', image: $request->file('logo')) : $market->logo;
        $market->cover_photo = $request->has('cover_photo') ? Helpers::update(dir: 'market/cover/', old_image: $market->cover_photo, format: 'png', image: $request->file('cover_photo')) : $market->cover_photo;
        $market->name = $request->name[array_search('default', $request->lang)];
        $market->address = $request->address[array_search('default', $request->lang)];
        $market->latitude = $request->latitude;
        $market->longitude = $request->longitude;
        $market->zone_id = $request->zone_id;
        $market->tax = $request->tax;
        $market->delivery_time = $request->minimum_delivery_time . '-' . $request->maximum_delivery_time . '-' . $request->delivery_time_type;
        $market->save();
        $market->tags()->sync($tag_ids);

        $default_lang = str_replace('_', '-', app()->getLocale());
        foreach ($request->lang as $index => $key) {
            if ($default_lang == $key && !($request->name[$index])) {
                if ($key != 'default') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type' => 'App\Models\Market',
                            'translationable_id' => $market->id,
                            'locale' => $key,
                            'key' => 'name'
                        ],
                        ['value' => $market->name]
                    );
                }
            } else {

                if ($request->name[$index] && $key != 'default') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type'  => 'App\Models\Market',
                            'translationable_id'    => $market->id,
                            'locale'                => $key,
                            'key'                   => 'name'
                        ],
                        ['value'                 => $request->name[$index]]
                    );
                }
            }
            if ($default_lang == $key && !($request->address[$index])) {
                if ($key != 'default') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type' => 'App\Models\Market',
                            'translationable_id' => $market->id,
                            'locale' => $key,
                            'key' => 'address'
                        ],
                        ['value' => $market->address]
                    );
                }
            } else {

                if ($request->address[$index] && $key != 'default') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type'  => 'App\Models\Market',
                            'translationable_id'    => $market->id,
                            'locale'                => $key,
                            'key'                   => 'address'
                        ],
                        ['value'                 => $request->address[$index]]
                    );
                }
            }
        }
        // $market?->cuisine()?->sync($cuisine_ids);
        if ($market?->userinfo) {
            $userinfo = $market->userinfo;
            $userinfo->f_name = $request->name;
            $userinfo->l_name = '';
            $userinfo->email = $request->email;
            $userinfo->image = $market->logo;
            $userinfo->save();
        }
        Toastr::success(translate('messages.market') . translate('messages.updated_successfully'));
        return redirect('admin/market/list');
    }

    public function destroy(Request $request, Market $market)
    {

        if (Storage::disk('public')->exists('market/' . $market['logo'])) {
            Storage::disk('public')->delete('market/' . $market['logo']);
        }
        $market = Vendor::findOrFail($market?->market?->id);
        $market?->delete();
        $market?->userinfo?->delete();
        $market?->delete();
        Toastr::success(translate('messages.market_removed'));
        return back();
    }

    public function view($market, Request $request, $tab = null, $sub_tab = 'cash')
    {
        $key = explode(' ', $request['search']);

        $market = Market::find($market);
        $wallet = $market?->market?->wallet;
        if (!$wallet) {
            $wallet = new MarketWallet();
            $wallet->vendor_id = $market?->vendor?->id;
            $wallet->total_earning = 0.0;
            $wallet->total_withdrawn = 0.0;
            $wallet->pending_withdraw = 0.0;
            $wallet->created_at = now();
            $wallet->updated_at = now();
            $wallet->save();
        }
        if ($tab == 'settings') {
            return view('admin-views.market.view.settings', compact('market'));
        } else if ($tab == 'order') {
            $orders = Order::where('market_id', $market->id)->with('customer')
                ->when(isset($key), function ($q) use ($key) {
                    $q->where(function ($q) use ($key) {
                        foreach ($key as $value) {
                            $q->orWhere('id', 'like', "%{$value}%");
                        }
                    });
                })
                ->latest()->Notpos()
                ->paginate(config('default_pagination'));


            return view('admin-views.market.view.order', compact('market', 'orders'));
        } else if ($tab == 'product') {


            $foods = Food::withoutGlobalScope(\App\Scopes\MarketScope::class)
                ->with('category.parent')
                ->where('market_id', $market->id)
                ->when(isset($key), function ($q) use ($key) {
                    $q->where(function ($q) use ($key) {
                        foreach ($key as $value) {
                            $q->where('name', 'like', "%{$value}%");
                        }
                    });
                })
                ->latest()->paginate(config('default_pagination'));

            return view('admin-views.market.view.product', compact('market', 'foods'));
        } else if ($tab == 'discount') {
            return view('admin-views.market.view.discount', compact('market'));
        } else if ($tab == 'transaction') {
            return view('admin-views.market.view.transaction', compact('market', 'sub_tab'));
        } else if ($tab == 'reviews') {
            return view('admin-views.market.view.review', compact('market', 'sub_tab'));
        } else if ($tab == 'conversations') {
            $user = UserInfo::where(['vendor_id' => $market?->market?->id])->first();
            if ($user) {
                $conversations = Conversation::with(['sender', 'receiver', 'last_message'])->WhereUser($user->id)
                    ->paginate(8);
            } else {
                $conversations = [];
            }
            return view('admin-views.market.view.conversations', compact('market', 'sub_tab', 'conversations'));
        } elseif ($tab == 'subscriptions') {

            $id = $market->id;
            if ($market->market_model == 'subscription' || $market->market_model == 'unsubscribed') {
                $rest_subscription = MarketSubscription::where('market_id', $id)->with(['package'])->latest()->first();
                $package_id =  $rest_subscription?->package_id ?? 0;
                $total_bill = SubscriptionTransaction::where('market_id', $id)->where('package_id', $package_id)->sum('paid_amount');
                $packages = SubscriptionPackage::where('status', 1)->get();
                return view('admin-views.market.view.subscriptions', compact('market', 'rest_subscription', 'package_id', 'total_bill', 'packages'));
            } else {
                abort(404);
            }
        } elseif ($tab == 'subscriptions-transactions') {
            $from = $request?->start_date;
            $to = $request?->end_date;
            $filter = $request->query('filter', 'all');
            $transcations = SubscriptionTransaction::where('market_id', $market->id)->with('package')
                ->when($filter == 'month', function ($query) {
                    return $query->whereMonth('created_at', Carbon::now()->month);
                })
                ->when($filter == 'year', function ($query) {
                    return $query->whereYear('created_at', Carbon::now()->year);
                })
                ->when(isset($key), function ($q) use ($key) {
                    $q->where(function ($q) use ($key) {
                        foreach ($key as $value) {
                            $q->orWhere('id', 'like', "%{$value}%")
                                ->orWhere('paid_amount', 'like', "%{$value}%")
                                ->orWhere('reference', 'like', "%{$value}%")
                                ->orWheredate('created_at', 'like', "%{$value}%");
                        }
                    });
                })
                ->when(isset($from) && isset($to), function ($q) use ($from, $to) {
                    $q->whereBetween('created_at', ["{$from}", "{$to} 23:59:59"]);
                })
                ->latest()->paginate(config('default_pagination'));
            $total = $transcations?->total();
            return view('admin-views.market.view.subs_transaction', [
                'transcations' => $transcations,
                'filter' => $filter,
                'total' => $total,
                'market' => $market,
                'from' =>  $from,
                'to' =>  $to,
            ]);
        } else if ($tab == 'meta-data') {
            return view('admin-views.market.view.meta-data', compact('market', 'sub_tab'));
        } else if ($tab == 'qr-code') {
            $data = json_decode($market->qr_code, true);
            $qr = base64_encode(json_encode($data));
            $code = isset($data) ? QrCode::size(180)->generate($data['website'] . '?qrcode=' . $qr) : '';
            return view('admin-views.market.view.qrcode', compact('market', 'data', 'code'));
        } else if ($tab == 'disbursements') {
            $disbursements = DisbursementDetails::where('market_id', $market->id)
                ->when(isset($key), function ($q) use ($key) {
                    $q->where(function ($q) use ($key) {
                        foreach ($key as $value) {
                            $q->orWhere('disbursement_id', 'like', "%{$value}%")
                                ->orWhere('status', 'like', "%{$value}%");
                        }
                    });
                })
                ->latest()->paginate(config('default_pagination'));
            return view('admin-views.market.view.disbursement', compact('market', 'disbursements'));
        } else if ($tab == 'pending-list') {

            return view('admin-views.market.pending_list_view', compact('market'));
        }

        return view('admin-views.market.view.index', compact('market', 'wallet'));
    }



    // public function rest_transcation_search(Request $request)
    // {
    //     $key = explode(' ', $request['search']);
    //     $transcations = SubscriptionTransaction::where('market_id',$request->id)->where(function ($q) use ($key) {
    //         foreach ($key as $value) {
    //             $q->orWhere('id', 'like', "%{$value}%")
    //                 ->orWhere('paid_amount', 'like', "%{$value}%")
    //                 ->orWhere('reference', 'like', "%{$value}%")
    //                 ->orWheredate('created_at', 'like', "%{$value}%");
    //         }
    //     })
    //         ->get();
    //     $total = $transcations?->count();
    //     return response()->json([
    //         'view' => view('admin-views.market.view.partials._rest_subs_transcation', compact('transcations','total'))->render(), 'total'=> $total
    //     ]);
    // }
    // public function trans_search_by_date(Request $request){
    //     $from=$request->start_date;
    //     $to= $request->end_date;
    //     $id= $request->id;
    //     $filter = 'all';
    //     $market=Market::findOrFail($id);
    //     $transcations=SubscriptionTransaction::where('market_id', $market->id)
    //     ->whereBetween('created_at', ["{$from}", "{$to} 23:59:59"])
    //     ->latest()->paginate(config('default_pagination'));
    //     $total = $transcations->total();
    //     return view('admin-views.market.view.subs_transaction',[
    //         'transcations' => $transcations,
    //         'filter' => $filter,
    //         'total' => $total,
    //         'market' => $market,
    //         'from' =>  $from,
    //         'to' =>  $to,
    //         ]);
    // }

    public function view_tab(Market $market)
    {
        Toastr::error(translate('messages.unknown_tab'));
        return back();
    }

    public function list(Request $request)
    {

        $key = explode(' ', $request['search']);
        $zone_id = $request->query('zone_id', 'all');

        $type = $request->query('type', 'all');
        $typ = $request->query('market_model', 'none');

        // return $typ ;
        $markets = Market::with(['zone', 'vendor'])
            ->latest()->paginate(config('default_pagination'));

        $zone = is_numeric($zone_id) ? Zone::findOrFail($zone_id) : null;

        
        return view('admin-views.market.list', compact('markets', 'zone', 'type', 'typ'));
    }


    public function categories($id)
    {

        $market = Market::findorfail($id);
        $categories = ParentCategory::with('Foods')->whereHasMorph(
            'parentable',
            [Market::class],
            function ($query) use ($id) {
                $query->where('parentable_id', $id);
            }
        )->get();


        return view('admin-views.market.view.menus', compact('categories', 'market'));
    }
    public function create_category_page($market_id)
    {
        return view('admin-views.market.view.add-new-menu', compact('market_id'));
    }
    public function add_new_category(Request $request)
    {

        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'image' => 'required',
            'market_id' => 'required',

        ], [
            'title.required' => translate('messages.title_is_required'),
            // 'additional_documents.max' => translate('You_can_chose_max_5_files_only'),
        ]);


        $menu = new ParentCategory();
        $menu->name = $request->name[array_search('default', $request->lang)];;
        $menu->image = $request->has('image') ? Helpers::upload(dir: 'category/', format: 'png', image: $request->file('image')) : 'def.png';
        $menu->parentable_id = $request->market_id;
        $menu->parentable_type = Market::class;
        $menu->save();


        $default_lang = str_replace('_', '-', app()->getLocale());
        $data = [];
        foreach ($request->lang as $index => $key) {
            if ($default_lang == $key && !($request->name[$index])) {
                if ($key != 'default') {
                    array_push($data, array(
                        'translationable_type' => 'App\Models\ParentCategory',
                        'translationable_id' => $menu->id,
                        'locale' => $key,
                        'key' => 'name',
                        'value' => $menu->name,
                    ));
                }
            } else {
                if ($request->name[$index] && $key != 'default') {
                    array_push($data, array(
                        'translationable_type' => 'App\Models\ParentCategory',
                        'translationable_id' => $menu->id,
                        'locale' => $key,
                        'key' => 'name',
                        'value' => $request->name[$index],
                    ));
                }
            }
        }
        Translation::insert($data);
        // Translation::insert($data);
        Toastr::success(translate('messages.menus') . translate('messages.added_successfully'));
        return redirect()->route('admin.market.categories', $request->market_id);
    }


    public function pending(Request $request)
    {
        $key = explode(' ', $request['search']);
        $zone_id = $request->query('zone_id', 'all');
        $type = $request->query('type', '');
        $typ = $request->query('market_model', '');
        $markets = Market::when(is_numeric($zone_id), function ($query) use ($zone_id) {
            return $query->where('zone_id', $zone_id);
        })
            ->when(isset($key), function ($query) use ($key) {
                $query->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->orWhere('name', 'like', "%{$value}%")
                            ->orWhere('email', 'like', "%{$value}%")
                            ->orWhere('phone', 'like', "%{$value}%");
                    }
                });
            })
            ->with(['market', 'zone'])
            ->whereHas('market', function ($q) {
                $q->where('status', null);
            })
            ->type($type)->marketModel($typ)->latest()->paginate(config('default_pagination'));
        $zone = is_numeric($zone_id) ? Zone::findOrFail($zone_id) : null;
        return view('admin-views.market.pending_list', compact('markets', 'zone', 'type', 'typ'));
    }
    public function denied(Request $request)
    {
        $key = explode(' ', $request['search']);
        $zone_id = $request->query('zone_id', 'all');
        $type = $request->query('type', '');
        $typ = $request->query('market_model', '');
        $markets = Market::when(is_numeric($zone_id), function ($query) use ($zone_id) {
            return $query->where('zone_id', $zone_id);
        })
            ->when(isset($key), function ($query) use ($key) {
                $query->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->orWhere('name', 'like', "%{$value}%")
                            ->orWhere('email', 'like', "%{$value}%")
                            ->orWhere('phone', 'like', "%{$value}%");
                    }
                });
            })
            ->with(['market', 'zone'])
            ->whereHas('market', function ($q) {
                $q->Where('status', 0);
            })
            ->type($type)->marketModel($typ)->latest()->paginate(config('default_pagination'));
        $zone = is_numeric($zone_id) ? Zone::findOrFail($zone_id) : null;
        return view('admin-views.market.denied', compact('markets', 'zone', 'type', 'typ'));
    }

    // public function search(Request $request)
    // {
    //     $key = explode(' ', $request['search']);
    //     $markets = Market::whereHas('market', function($q){
    //             $q->where('status',1);
    //         })
    //         ->where(function($query)use ($key){
    //             $query->orWhereHas('market', function ($q) use ($key) {
    //                 foreach ($key as $value) {
    //                     $q->orWhere('f_name', 'like', "%{$value}%")
    //                         ->orWhere('l_name', 'like', "%{$value}%")
    //                         ->orWhere('email', 'like', "%{$value}%")
    //                         ->orWhere('phone', 'like', "%{$value}%");
    //                 }
    //             })
    //             ->where(function ($q) use ($key) {
    //                     foreach ($key as $value) {
    //                         $q->orWhere('name', 'like', "%{$value}%")
    //                             ->orWhere('email', 'like', "%{$value}%")
    //                             ->orWhere('phone', 'like', "%{$value}%");
    //                     }
    //                 });
    //         })
    //             ->withSum('reviews' , 'rating')
    //             ->withCount('reviews')
    //             ->get();
    //     $total = $markets?->count();
    //     return response()->json([
    //         'view' => view('admin-views.market.partials._table', compact('markets'))->render(), 'total' => $total
    //     ]);
    // }

    public function get_markets(Request $request)
    {

        $zone_ids = isset($request->zone_ids) ? (count($request->zone_ids) > 0 ? $request->zone_ids : []) : 0;
        $zone_id = $request->zone_id ??  null;
        $data = Market::with('zone')->when($zone_ids, function ($query) use ($zone_ids) {
                $query->whereIn('markets.zone_id', $zone_ids);
            })
            ->when($zone_id, function ($query) use ($zone_id) {
                $query->where('markets.zone_id', $zone_id);
            })

            ->where('markets.name', 'like', '%' . $request->q . '%')
            ->limit(8)->get()
            ->map(function ($market) {
                return [
                    'id' => $market->id,
                    'text' => $market->name . ' (' . $market->zone?->name . ')',
                ];
            });

        if (isset($request->all)) {
            $data[] = (object)['id' => 'all', 'text' => 'All'];
        }

        return response()->json($data);
    }

    public function status(Market $market, Request $request)
    {
        $market->status = $request->status;
        $market?->save();
        $market = $market?->market;

        //        try {
        //            if ($request->status == 0) {
        //                $market->auth_token = null;
        //                if (isset($market->fcm_token)) {
        //                    $data = [
        //                        'title' => translate('messages.suspended'),
        //                        'description' => translate('messages.your_account_has_been_suspended'),
        //                        'order_id' => '',
        //                        'image' => '',
        //                        'type' => 'block'
        //                    ];
        //                    Helpers::send_push_notif_to_device($market->fcm_token, $data);
        //                    DB::table('user_notifications')->insert([
        //                        'data' => json_encode($data),
        //                        'vendor_id' => $market->id,
        //                        'created_at' => now(),
        //                        'updated_at' => now()
        //                    ]);
        //                }
        //            }
        //        } catch (\Exception $e) {
        //            info($e->getMessage());
        //            Toastr::warning(translate('messages.push_notification_faild'));
        //        }

        try {
            if ($request->status == 0) {
                $market->auth_token = null;

                if (isset($market->fcm_token)) {
                    $data = [
                        'title' => translate('messages.suspended'),
                        'description' => translate('messages.your_account_has_been_suspended'),
                        'order_id' => '',
                        'image' => '',
                        'type' => 'block'
                    ];
                    Helpers::send_push_notif_to_device($market->fcm_token, $data);
                    DB::table('user_notifications')->insert([
                        'data' => json_encode($data),
                        'vendor_id' => $market->id,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }



                $mail_status = Helpers::get_mail_status('suspend_mail_status_market');
                if (config('mail.status') && $mail_status == '1') {
                    Mail::to($market?->market?->email)->send(new \App\Mail\VendorStatus('suspended', $market?->market?->f_name . ' ' . $market?->market?->l_name));
                }
            } else {
                $mail_status = Helpers::get_mail_status('unsuspend_mail_status_market');
                if (config('mail.status') && $mail_status == '1') {
                    Mail::to($market?->market?->email)->send(new \App\Mail\VendorStatus('unsuspended', $market?->market?->f_name . ' ' . $market?->market?->l_name));
                }
            }
        } catch (\Exception $ex) {
            info($ex->getMessage());
        }

        Toastr::success(translate('messages.market') . translate('messages.status_updated'));
        return back();
    }

    public function market_status(Market $market, Request $request)
    {
        if ($request->menu == "schedule_order" && !Helpers::schedule_order()) {
            Toastr::warning(translate('messages.schedule_order_disabled_warning'));
            return back();
        }
        $home_delivery = BusinessSetting::where('key', 'home_delivery')->first()?->value ?? null;
        if ($request->menu == "delivery" && !$home_delivery) {
            Toastr::warning(translate('messages.Home_delivery_is_disabled_by_admin'));
            return back();
        }
        $take_away = BusinessSetting::where('key', 'take_away')->first()?->value ?? null;
        if ($request->menu == "take_away" && !$take_away) {
            Toastr::warning(translate('messages.Take_away_is_disabled_by_admin'));
            return back();
        }

        $instant_order = BusinessSetting::where('key', 'instant_order')->first()?->value ?? null;
        if ($request->menu == "instant_order" && !$instant_order && $request->status == 1) {
            Toastr::warning(translate('messages.instant_order_is_disabled_by_admin'));
            return back();
        }

        if ((($request->menu == "delivery" && $market->take_away == 0) || ($request->menu == "take_away" && $market->delivery == 0)) &&  $request->status == 0) {
            Toastr::warning(translate('messages.can_not_disable_both_take_away_and_delivery'));
            return back();
        }

        if ((($request->menu == "veg" && $market->non_veg == 0) || ($request->menu == "non_veg" && $market->veg == 0)) &&  $request->status == 0) {
            Toastr::warning(translate('messages.veg_non_veg_disable_warning'));
            return back();
        }
        if ($request->menu == "self_delivery_system" && $request->status == '0') {
            $market['free_delivery'] = 0;
            $market?->coupon()?->where('created_by', 'market')->where('coupon_type', 'free_delivery')?->delete();
        }

        if ((($request->menu == "instant_order" && $market->schedule_order == 0) || (isset($market->market_config)   && ($request->menu == "schedule_order" && $market?->market_config?->instant_order == 0))) &&  $request->status == 0 && $instant_order) {
            Toastr::warning(translate('messages.can_not_disable_both_instant_order_and_schedule_order'));
            return back();
        }

        if ($request->menu == 'instant_order'  || $request->menu == 'customer_date_order_sratus' || $request->menu == 'halal_tag_status') {
            $conf = marketConfig::firstOrNew(
                ['market_id' =>  $market->id]
            );
            $conf[$request->menu] = $request->status;
            $conf->save();
            Toastr::success(translate('messages.market_settings_updated!'));
            return back();
        }


        $market[$request->menu] = $request->status;
        $market?->save();
        Toastr::success(translate('messages.market_settings_updated'));
        return back();
    }

    public function discountSetup(Market $market, Request $request)
    {
        $message = translate('messages.discount');
        $message .= $market->discount ? translate('messages.updated_successfully') : translate('messages.added_successfully');
        $market?->discount()?->updateOrinsert(
            [
                'market_id' => $market->id
            ],
            [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'min_purchase' => $request->min_purchase != null ? $request->min_purchase : 0,
                'max_discount' => $request->max_discount != null ? $request->max_discount : 0,
                'discount' => $request->discount_type == 'amount' ? $request->discount : $request['discount'],
                'discount_type' => 'percent'
            ]
        );
        return response()->json(['message' => $message], 200);
    }

    public function updatemarketSettings(Market $market, Request $request)
    {

        if (isset($request->market_model)) {
            if ($request->market_model == 'subscription') {
                $market->market_model = 'unsubscribed';
                $market->status = 0;
            } elseif ($request->market_model == 'commission') {
                $market->market_model = 'commission';
            }
            if (isset($market->market_sub)) {
                $market->market_sub->update([
                    'status' => 0,
                ]);
            }
            $market->save();
            Toastr::success(translate('messages.market') . ' ' . translate('messages.Business_Model_Updated'));
            return back();
        }

        $request->validate([
            'minimum_order' => 'required',
            // 'comission' => 'required',
            'tax' => 'required',
            'minimum_delivery_time' => 'required',
            'maximum_delivery_time' => 'required|gt:minimum_delivery_time',
            'delivery_time_type' => 'required',

        ]);

        if ($request->comission_status) {
            $market->comission = $request->comission;
        } else {
            $market->comission = null;
        }

        if ($request->delivery_time_type == 'min') {
            $minimum_delivery_time = (int) $request->input('minimum_delivery_time');
            if ($minimum_delivery_time < 10) {
                Toastr::error(translate('messages.market') . translate('messages.minimum_delivery_time_should_be_more_than_10_min'));
                return back();
            }
        }


        $market->minimum_order = $request->minimum_order;
        $market->opening_time = $request->opening_time;
        $market->closeing_time = $request->closeing_time;
        $market->tax = $request->tax;
        $market->delivery_time = $request->minimum_delivery_time . '-' . $request->maximum_delivery_time . '-' . $request->delivery_time_type;
        if ($request->menu == "veg") {
            $market->veg = 1;
            $market->non_veg = 0;
        } elseif ($request->menu == "non-veg") {
            $market->veg = 0;
            $market->non_veg = 1;
        } elseif ($request->menu == "both") {
            $market->veg = 1;
            $market->non_veg = 1;
        }
        $market->save();

        $conf = MarketConfig::firstOrNew(
            ['market_id' =>  $market->id]
        );
        $conf->customer_order_date = $request->customer_order_date ?? 0;
        $conf->save();

        Toastr::success(translate('messages.market_settings_updated'));
        return back();
    }

    public function update_application($id, $status)
    {
        $market = Market::findOrFail($id);
        $market->vendor->status = $status;
        $market?->vendor?->save();
        if ($status) $market->status = 1;
        if ($market?->market_sub_update_application && $market?->market_sub_trans?->payment_method == 'free_trial') {
            $free_trial_period_data = json_decode(BusinessSetting::where(['key' => 'free_trial_period'])->first()?->value, true);
            $free_trial_period =  $free_trial_period_data['data'] ??  0;
            $market->market_sub_update_application->update([
                'expiry_date' => Carbon::now()->addDays($free_trial_period)->format('Y-m-d'),
                'status' => 1
            ]);
            $market->market_model = 'subscription';
        } elseif ($market?->market_sub_trans && $market?->market_sub_update_application && $market?->market_sub_trans?->payment_method != 'free_trial') {
            $add_days = $market->market_sub_trans->validity;
            $market->market_sub_update_application->update([
                'expiry_date' => Carbon::now()->addDays($add_days)->format('Y-m-d'),
                'status' => 1
            ]);
            $market->market_model = 'subscription';
        }
        $market?->save();
        try {
            if ($status == 1) {
                $mail_status = Helpers::get_mail_status('approve_mail_status_market');
                if (config('mail.status') && $mail_status == '1') {
                    Mail::to($market?->market?->email)->send(new \App\Mail\VendorSelfRegistration('approved', $market?->market?->f_name . ' ' . $market?->market?->l_name));
                }
            } else {
                $mail_status = Helpers::get_mail_status('deny_mail_status_market');
                if (config('mail.status') && $mail_status == '1') {
                    Mail::to($market?->market?->email)->send(new \App\Mail\VendorSelfRegistration('denied', $market?->market?->f_name . ' ' . $market?->market?->l_name));
                }
            }
        } catch (\Exception $ex) {
            info($ex->getMessage());
        }
        Toastr::success(translate('messages.application_status_updated_successfully'));
        return back();
    }

    public function cleardiscount(Market $market)
    {
        $market?->discount?->delete();
        Toastr::success(translate('messages.market') . translate('messages.discount_cleared'));
        return back();
    }

    public function withdraw(Request $request)
    {
        $key = isset($request['search']) ? explode(' ', $request['search']) : [];

        $all = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'all' ? 1 : 0;
        $active = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'approved' ? 1 : 0;
        $denied = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'denied' ? 1 : 0;
        $pending = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'pending' ? 1 : 0;

        $withdraw_req = WithdrawRequest::with(['market', 'market.markets'])
            ->when($all, function ($query) {
                return $query;
            })
            ->when($active, function ($query) {
                return $query->where('approved', 1);
            })
            ->when($denied, function ($query) {
                return $query->where('approved', 2);
            })
            ->when($pending, function ($query) {
                return $query->where('approved', 0);
            })
            ->when(isset($key), function ($query) use ($key) {
                return $query->whereHas('market', function ($query) use ($key) {
                    $query->whereHas('markets', function ($q) use ($key) {
                        foreach ($key as $value) {
                            $q->where('name', 'like', "%{$value}%");
                        }
                    });
                });
            })
            ->latest()
            ->paginate(config('default_pagination'));

        return view('admin-views.wallet.withdraw', compact('withdraw_req'));
    }

    public function withdraw_view($withdraw_id, $seller_id)
    {
        $wr = WithdrawRequest::with(['market', 'method:id,method_name'])->where(['id' => $withdraw_id])->first();
        return view('admin-views.wallet.withdraw-view', compact('wr'));
    }

    public function status_filter(Request $request)
    {
        session()->put('withdraw_status_filter', $request['withdraw_status_filter']);
        return response()->json(session('withdraw_status_filter'));
    }

    public function withdrawStatus(Request $request, $id)
    {
        $withdraw = WithdrawRequest::findOrFail($id);
        $withdraw->approved = $request->approved;
        $withdraw->transaction_note = $request['note'];
        $wallet = marketWallet::where('vendor_id', $withdraw->vendor_id)->first();
        if ($wallet->total_earning < ($wallet->total_withdrawn + $wallet->pending_withdraw)) {
            Toastr::error(translate('messages.Blalnce_mismatched_total_earning_is_too_low'));
            return redirect()->route('admin.market.withdraw_list');
        }

        if ($request->approved == 1) {
            $wallet->increment('total_withdrawn', $withdraw->amount);
            $wallet->decrement('pending_withdraw', $withdraw->amount);
            $withdraw->save();
            try {
                if (config('mail.status') && Helpers::get_mail_status('withdraw_approve_mail_status_market') == '1') {
                    Mail::to($withdraw->market->email)->send(new \App\Mail\WithdrawRequestMail('approved', $withdraw));
                }
            } catch (\Exception $e) {
                info($e->getMessage());
            }
            Toastr::success(translate('messages.seller_payment_approved'));
            return redirect()->route('admin.market.withdraw_list');
        } else if ($request->approved == 2) {
            try {
                if (config('mail.status') && Helpers::get_mail_status('withdraw_deny_mail_status_market') == '1') {
                    Mail::to($withdraw->market->email)->send(new \App\Mail\WithdrawRequestMail('denied', $withdraw));
                }
            } catch (\Exception $e) {
                info($e->getMessage());
            }
            $wallet->decrement('pending_withdraw', $withdraw->amount);
            $withdraw->save();
            Toastr::info(translate('messages.seller_payment_denied'));
            return redirect()->route('admin.market.withdraw_list');
        } else {
            Toastr::error(translate('messages.not_found'));
            return back();
        }
    }

    public function get_addons(Request $request)
    {
        $cat = AddOn::withoutGlobalScope(marketScope::class)->where(['market_id' => $request->market_id])->active()->get();
        $res = '';
        foreach ($cat as $row) {
            $res .= '<option value="' . $row->id . '"';
            if (count($request->data)) {
                $res .= in_array($row->id, $request->data) ? 'selected' : '';
            }
            $res .=  '>' . $row->name . '</option>';
        }
        return response()->json([
            'options' => $res,
        ]);
    }

    public function get_market_data(Market $market)
    {
        return response()->json($market);
    }

    public function market_filter($id)
    {
        if ($id == 'all') {
            if (session()->has('market_filter')) {
                session()->forget('market_filter');
            }
        } else {
            session()->put('market_filter', Market::where('id', $id)->first(['id', 'name']));
        }
        return back();
    }

    public function get_account_data(Market $market)
    {
        $wallet = $market?->market?->wallet;
        $cash_in_hand = 0;
        $balance = 0;

        if ($wallet) {
            $cash_in_hand = $wallet->collected_cash;
            $balance = $wallet->balance;
            // $balance = $wallet->total_earning - $wallet->total_withdrawn - $wallet->pending_withdraw - $wallet->collected_cash;
        }
        return response()->json(['cash_in_hand' => $cash_in_hand, 'earning_balance' => $balance], 200);
    }

    public function bulk_import_index()
    {
        return view('admin-views.market.bulk-import');
    }

    public function bulk_import_data(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'upload_excel' => 'required|max:2048',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        try {
            $collections = (new FastExcel)->import($request->file('upload_excel'));
        } catch (\Exception $exception) {
            info(["line___{$exception->getLine()}", $exception->getMessage()]);
            Toastr::error(translate('messages.you_have_uploaded_a_wrong_format_file'));
            return back();
        }
        $duplicate_phones = $collections->duplicates('phone');
        $duplicate_emails = $collections->duplicates('email');

        if ($duplicate_emails->isNotEmpty()) {
            Toastr::error(translate('messages.duplicate_data_on_column', ['field' => translate('messages.email')]));
            return back();
        }

        if ($duplicate_phones->isNotEmpty()) {
            Toastr::error(translate('messages.duplicate_data_on_column', ['field' => translate('messages.phone')]));
            return back();
        }
        $vendors = [];
        $markets = [];
        if ($request->button === 'import') {

            $email = $collections->pluck('email')->toArray();
            $phone = $collections->pluck('phone')->toArray();

            if (Market::whereIn('email', $email)->orWhereIn('phone', $phone)->exists()) {
                Toastr::error(translate('messages.duplicate_email_or_phone_exists_at_the_database'));
                return back();
            }

            $market = Vendor::orderBy('id', 'desc')->first('id');
            $vendor_id = $market ? $market->id : 0;
            try {
                foreach ($collections as $key => $collection) {
                    if (
                        !isset($collection['id'])   || $collection['id'] === "" ||  $collection['ownerFirstName'] === "" || $collection['marketName'] === "" || $collection['phone'] === "" || $collection['Comission'] === "" || $collection['Tax'] === ""
                        || $collection['email'] === "" || $collection['latitude'] === "" || $collection['longitude'] === ""
                        || $collection['zone_id'] === "" ||  $collection['DeliveryTime'] === ""  || $collection['marketModel'] === ""
                    ) {
                        Toastr::error(translate('messages.please_fill_all_required_fields'));
                        return back();
                    }
                    if (isset($collection['DeliveryTime']) && explode("-", (string)$collection['DeliveryTime'])[0] >  explode("-", (string)$collection['DeliveryTime'])[1]) {
                        Toastr::error(translate('messages.max_delivery_time_must_be_greater_than_min_delivery_time_on_id') . ' ' . $collection['id']);
                        return back();
                    }
                    if (isset($collection['Comission']) && ($collection['Comission'] < 0 ||  $collection['Comission'] > 100)) {
                        Toastr::error(translate('messages.Comission_must_be_in_0_to_100_on_id') . ' ' . $collection['id']);
                        return back();
                    }
                    if (isset($collection['Tax']) && ($collection['Tax'] < 0 ||  $collection['Tax'] > 100)) {
                        Toastr::error(translate('messages.Tax_must_be_in_0_to_100_on_Id') . ' ' . $collection['id']);
                        return back();
                    }
                    if (isset($collection['latitude']) && ($collection['latitude'] < -90 ||  $collection['latitude'] > 90)) {
                        Toastr::error(translate('messages.latitude_must_be_in_-90_to_90_on_Id') . ' ' . $collection['id']);
                        return back();
                    }
                    if (isset($collection['longitude']) && ($collection['longitude'] < -180 ||  $collection['longitude'] > 180)) {
                        Toastr::error(translate('messages.longitude_must_be_in_-180_to_180_on_Id') . ' ' . $collection['id']);
                        return back();
                    }
                    if (isset($collection['MinimumDeliveryFee']) && ($collection['MinimumDeliveryFee'] < 0)) {
                        Toastr::error(translate('messages.Enter_valid_Minimum_Delivery_Fee_on_Id') . ' ' . $collection['id']);
                        return back();
                    }
                    if (isset($collection['MinimumOrderAmount']) && ($collection['MinimumOrderAmount'] < 0)) {
                        Toastr::error(translate('messages.Enter_valid_Minimum_Order_Amount_on_Id') . ' ' . $collection['id']);
                        return back();
                    }
                    if (isset($collection['PerKmDeliveryFee']) && ($collection['PerKmDeliveryFee'] < 0)) {
                        Toastr::error(translate('messages.Enter_valid_Per_Km_Delivery_Fee_on_Id') . ' ' . $collection['id']);
                        return back();
                    }
                    if (isset($collection['MaximumDeliveryFee']) && ($collection['MaximumDeliveryFee'] < 0)) {
                        Toastr::error(translate('messages.Enter_valid_Maximum_Delivery_Fee_on_Id') . ' ' . $collection['id']);
                        return back();
                    }

                    array_push($vendors, [
                        'id' => $vendor_id + $key + 1,
                        'f_name' => $collection['ownerFirstName'],
                        'l_name' => $collection['ownerLastName'],
                        'password' => bcrypt(12345678),
                        'phone' => $collection['phone'],
                        'email' => $collection['email'],
                        'status' => 1,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                    array_push($markets, [
                        'name' => $collection['marketName'],
                        'logo' => $collection['logo'] ?? null,
                        'cover_photo' => $collection['CoverPhoto'] ?? null,
                        'phone' => $collection['phone'],
                        'email' => $collection['email'],
                        'latitude' => $collection['latitude'],
                        'longitude' => $collection['longitude'],
                        'vendor_id' => $vendor_id + $key + 1,
                        'zone_id' => $collection['zone_id'],
                        'address' => $collection['Address'] ?? null,
                        'tax' => $collection['Tax'] ?? 0,
                        'minimum_order' => $collection['MinimumOrderAmount'] ?? 0,
                        'delivery_time' => $collection['DeliveryTime'] ?? '15-30',
                        'comission' => $collection['Comission'] ?? 'comission',
                        'minimum_shipping_charge' => $collection['MinimumDeliveryFee'] ?? 0,
                        'per_km_shipping_charge' => $collection['PerKmDeliveryFee'] ?? 0,
                        'maximum_shipping_charge' => $collection['MaximumDeliveryFee'] ?? 0,
                        'market_model' =>  $collection['marketModel'] == 'subscription' ? 'unsubscribed' : 'commission',
                        'schedule_order' => $collection['ScheduleOrder'] == 'yes' ? 1 : 0,
                        'take_away' => $collection['TakeAway'] == 'yes' ? 1 : 0,
                        'free_delivery' => $collection['FreeDelivery']  == 'yes' ? 1 : 0,
                        'veg' => $collection['Veg']  == 'yes' ? 1 : 0,
                        'non_veg' => $collection['NonVeg']  == 'yes' ? 1 : 0,
                        'order_subscription_active' => $collection['OrderSubscription'] == 'yes' ? 1 : 0,

                        'delivery' => $collection['Delivery']  == 'yes' ? 1 : 0,
                        'status' => $collection['Status']  == 'active' ? 1 : 0,
                        'food_section' => $collection['FoodSection']  == 'active' ? 1 : 0,
                        'reviews_section' => $collection['ReviewsSection']   == 'active' ? 1 : 0,
                        'pos_system' => $collection['PosSystem']  == 'active' ? 1 : 0,
                        'self_delivery_system' => $collection['SelfDeliverySystem']  == 'active' ? 1 : 0,
                        'active' => $collection['marketOpen']  == 'yes' ? 1 : 0,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
                $market_ids[] = $vendor_id + $key + 1;
                $data = array_map(function ($id) {
                    return array_map(function ($item) use ($id) {
                        return     ['market_id' => $id, 'day' => $item, 'opening_time' => '00:00:00', 'closing_time' => '23:59:59'];
                    }, [0, 1, 2, 3, 4, 5, 6]);
                }, $market_ids);
            } catch (\Exception $e) {
                info(["line___{$e->getLine()}", $e->getMessage()]);
                Toastr::error(translate('messages.failed_to_import_data'));
                return back();
            }
            try {
                $chunkSize = 100;
                $chunk_markets = array_chunk($markets, $chunkSize);
                $chunk_vendors = array_chunk($vendors, $chunkSize);

                DB::beginTransaction();
                foreach ($chunk_markets as $key => $chunk_market) {
                    DB::table('vendors')->insert($chunk_vendors[$key]);
                    DB::table('markets')->insert($chunk_market);
                }

                DB::table('market_schedule')->insert(array_merge(...$data));
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                info(["line___{$e->getLine()}", $e->getMessage()]);
                Toastr::error(translate('messages.failed_to_import_data'));
                return back();
            }

            Toastr::success(translate('messages.market_imported_successfully', ['count' => count($markets)]));
            return back();
        }


        if ($request->button === 'update') {

            $email = $collections->pluck('email')->toArray();
            $phone = $collections->pluck('phone')->toArray();
            if (Market::whereIn('email', $email)->orWhereIn('phone', $phone)->doesntExist()) {
                Toastr::error(translate('messages.email_or_phone_doesnt_exist_at_the_database'));
                return back();
            }
            try {
                foreach ($collections as $key => $collection) {
                    if (
                        !isset($collection['id'])   || $collection['id'] === "" ||  $collection['ownerFirstName'] === "" || $collection['marketName'] === "" || $collection['phone'] === "" || $collection['Comission'] === "" || $collection['Tax'] === ""
                        || $collection['email'] === "" || $collection['latitude'] === "" || $collection['longitude'] === ""
                        || $collection['zone_id'] === "" ||  $collection['DeliveryTime'] === ""  || $collection['marketModel'] === ""
                    ) {
                        Toastr::error(translate('messages.please_fill_all_required_fields'));
                        return back();
                    }
                    if (isset($collection['DeliveryTime']) && explode("-", (string)$collection['DeliveryTime'])[0] >  explode("-", (string)$collection['DeliveryTime'])[1]) {
                        Toastr::error(translate('messages.max_delivery_time_must_be_greater_than_min_delivery_time_on_id') . ' ' . $collection['id']);
                        return back();
                    }
                    if (isset($collection['Comission']) && ($collection['Comission'] < 0 ||  $collection['Comission'] > 100)) {
                        Toastr::error(translate('messages.Comission_must_be_in_0_to_100_on_id') . ' ' . $collection['id']);
                        return back();
                    }
                    if (isset($collection['Tax']) && ($collection['Tax'] < 0 ||  $collection['Tax'] > 100)) {
                        Toastr::error(translate('messages.Tax_must_be_in_0_to_100_on_id') . ' ' . $collection['id']);
                        return back();
                    }
                    if (isset($collection['latitude']) && ($collection['latitude'] < -90 ||  $collection['latitude'] > 90)) {
                        Toastr::error(translate('messages.latitude_must_be_in_-90_to_90_on_id') . ' ' . $collection['id']);
                        return back();
                    }
                    if (isset($collection['longitude']) && ($collection['longitude'] < -180 ||  $collection['longitude'] > 180)) {
                        Toastr::error(translate('messages.longitude_must_be_in_-180_to_180_on_id') . ' ' . $collection['id']);
                        return back();
                    }
                    if (isset($collection['MinimumDeliveryFee']) && ($collection['MinimumDeliveryFee'] < 0)) {
                        Toastr::error(translate('messages.Enter_valid_Minimum_Delivery_Fee_on_id') . ' ' . $collection['id']);
                        return back();
                    }
                    if (isset($collection['MinimumOrderAmount']) && ($collection['MinimumOrderAmount'] < 0)) {
                        Toastr::error(translate('messages.Enter_valid_Minimum_Order_Amount_on_id') . ' ' . $collection['id']);
                        return back();
                    }
                    if (isset($collection['PerKmDeliveryFee']) && ($collection['PerKmDeliveryFee'] < 0)) {
                        Toastr::error(translate('messages.Enter_valid_Per_Km_Delivery_Fee_on_id') . ' ' . $collection['id']);
                        return back();
                    }
                    if (isset($collection['MaximumDeliveryFee']) && ($collection['MaximumDeliveryFee'] < 0)) {
                        Toastr::error(translate('messages.Enter_valid_Maximum_Delivery_Fee_on_id') . ' ' . $collection['id']);
                        return back();
                    }

                    array_push($vendors, [
                        'id' => $collection['ownerID'],
                        'f_name' => $collection['ownerFirstName'],
                        'l_name' => $collection['ownerLastName'],
                        'phone' => $collection['phone'],
                        'email' => $collection['email'],
                        'status' => 1,
                        'password' => bcrypt(12345678),
                        'updated_at' => now()
                    ]);
                    array_push($markets, [
                        'id' => $collection['id'],
                        'name' => $collection['marketName'],
                        'logo' => $collection['logo'] ?? null,
                        'cover_photo' => $collection['CoverPhoto'] ?? null,
                        'phone' => $collection['phone'],
                        'email' => $collection['email'],
                        'latitude' => $collection['latitude'],
                        'longitude' => $collection['longitude'],
                        'vendor_id' => $collection['ownerID'],
                        'zone_id' => $collection['zone_id'],
                        'address' => $collection['Address'] ?? null,
                        'tax' => $collection['Tax'] ?? 0,
                        'minimum_order' => $collection['MinimumOrderAmount'] ?? 0,
                        'delivery_time' => $collection['DeliveryTime'] ?? '15-30',
                        'comission' => $collection['Comission'] ?? 'comission',
                        'minimum_shipping_charge' => $collection['MinimumDeliveryFee'] ?? 0,
                        'per_km_shipping_charge' => $collection['PerKmDeliveryFee'] ?? 0,
                        'maximum_shipping_charge' => $collection['MaximumDeliveryFee'] ?? 0,
                        'market_model' =>  $collection['marketModel']  == 'subscription' ? 'unsubscribed' : 'commission',
                        'order_subscription_active' => $collection['OrderSubscription']  == 'yes' ? 1 : 0,
                        'schedule_order' => $collection['ScheduleOrder']  == 'yes' ? 1 : 0,
                        'take_away' => $collection['TakeAway']  == 'yes' ? 1 : 0,
                        'free_delivery' => $collection['FreeDelivery']   == 'yes' ? 1 : 0,
                        'veg' => $collection['Veg']   == 'yes' ? 1 : 0,
                        'non_veg' => $collection['NonVeg']   == 'yes' ? 1 : 0,
                        'delivery' => $collection['Delivery']   == 'yes' ? 1 : 0,
                        'status' => $collection['Status']   == 'active' ? 1 : 0,
                        'food_section' => $collection['FoodSection']   == 'active' ? 1 : 0,
                        'reviews_section' => $collection['ReviewsSection']    == 'active' ? 1 : 0,
                        'pos_system' => $collection['PosSystem']   == 'active' ? 1 : 0,
                        'self_delivery_system' => $collection['SelfDeliverySystem']   == 'active' ? 1 : 0,
                        'active' => $collection['marketOpen']   == 'yes' ? 1 : 0,
                        'updated_at' => now()
                    ]);
                }
            } catch (\Exception $e) {
                info(["line___{$e->getLine()}", $e->getMessage()]);
                Toastr::error(translate('messages.failed_to_update_data'));
                return back();
            }

            try {

                $chunkSize = 100;
                $chunk_markets = array_chunk($markets, $chunkSize);
                $chunk_vendors = array_chunk($vendors, $chunkSize);
                DB::beginTransaction();
                foreach ($chunk_markets as $key => $chunk_market) {
                    DB::table('vendors')->upsert($chunk_vendors[$key], ['id', 'email', 'phone', 'password'], ['f_name', 'l_name']);
                    DB::table('markets')->upsert($chunk_market, ['id', 'email', 'phone', 'vendor_id',], ['name', 'logo', 'cover_photo', 'latitude', 'longitude', 'address', 'zone_id', 'minimum_order', 'comission', 'tax', 'delivery_time', 'minimum_shipping_charge', 'per_km_shipping_charge', 'maximum_shipping_charge', 'schedule_order', 'status', 'self_delivery_system', 'veg', 'non_veg', 'free_delivery', 'take_away', 'delivery', 'reviews_section', 'pos_system', 'active', 'market_model', 'food_section', 'order_subscription_active']);
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                info(["line___{$e->getLine()}", $e->getMessage()]);
                Toastr::error(translate('messages.failed_to_update_data'));
                return back();
            }
            Toastr::success(translate('messages.market_update_successfully', ['count' => count($markets)]));
            return back();
        }
    }

    public function bulk_export_index()
    {
        return view('admin-views.market.bulk-export');
    }

    public function bulk_export_data(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'start_id' => 'required_if:type,id_wise',
            'end_id' => 'required_if:type,id_wise',
            'from_date' => 'required_if:type,date_wise',
            'to_date' => 'required_if:type,date_wise'
        ]);
        $vendors = Vendor::with('markets')->has('markets')
            ->when($request['type'] == 'date_wise', function ($query) use ($request) {
                $query->whereBetween('created_at', [$request['from_date'] . ' 00:00:00', $request['to_date'] . ' 23:59:59']);
            })
            ->when($request['type'] == 'id_wise', function ($query) use ($request) {
                $query->whereBetween('id', [$request['start_id'], $request['end_id']]);
            })
            ->when($request->type == 'all', function ($q) {
                $q->where('status', 1);
            })
            ->get();

        // Export consumes only a few MB, even with 10M+ rows.
        return (new FastExcel(marketLogic::format_export_markets(Helpers::Export_generator($vendors))))->download('markets.xlsx');
    }

    public function add_schedule(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'market_id' => 'required',
        ], [
            'end_time.after' => translate('messages.End time must be after the start time')
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)]);
        }

        $temp = marketSchedule::where('day', $request->day)->where('market_id', $request->market_id)
            ->where(function ($q) use ($request) {
                return $q->where(function ($query) use ($request) {
                    return $query->where('opening_time', '<=', $request->start_time)->where('closing_time', '>=', $request->start_time);
                })->orWhere(function ($query) use ($request) {
                    return $query->where('opening_time', '<=', $request->end_time)->where('closing_time', '>=', $request->end_time);
                });
            })
            ->first();

        if (isset($temp)) {
            return response()->json(['errors' => [
                ['code' => 'time', 'message' => translate('messages.schedule_overlapping_warning')]
            ]]);
        }

        $market = Market::find($request->market_id);
        $market_schedule = marketSchedule::insert(['market_id' => $request->market_id, 'day' => $request->day, 'opening_time' => $request->start_time, 'closing_time' => $request->end_time]);

        return response()->json([
            'view' => view('admin-views.market.view.partials._schedule', compact('market'))->render(),
        ]);
    }

    public function remove_schedule($market_schedule)
    {
        $schedule = marketSchedule::find($market_schedule);
        if (!$schedule) {
            return response()->json([], 404);
        }
        $market = $schedule?->market;
        $schedule?->delete();
        return response()->json([
            'view' => view('admin-views.market.view.partials._schedule', compact('market'))->render(),
        ]);
    }





    public function conversation_list(Request $request)
    {

        $user = UserInfo::where('vendor_id', $request->user_id)->first();
        $conversations = Conversation::WhereUser($user->id);
        if ($request->query('key') != null) {
            $key = explode(' ', $request->get('key'));
            $conversations = $conversations->where(function ($qu) use ($key) {
                $qu->whereHas('sender', function ($query) use ($key) {
                    foreach ($key as $value) {
                        $query->where('f_name', 'like', "%{$value}%")->orWhere('l_name', 'like', "%{$value}%")->orWhere('phone', 'like', "%{$value}%");
                    }
                })->orWhereHas('receiver', function ($query1) use ($key) {
                    foreach ($key as $value) {
                        $query1->where('f_name', 'like', "%{$value}%")->orWhere('l_name', 'like', "%{$value}%")->orWhere('phone', 'like', "%{$value}%");
                    }
                });
            });
        }
        $conversations = $conversations->paginate(8);
        $view = view('admin-views.market.view.partials._conversation_list', compact('conversations'))->render();
        return response()->json(['html' => $view]);
    }

    public function conversation_view($conversation_id, $user_id)
    {
        $convs = Message::where(['conversation_id' => $conversation_id])->get();
        $conversation = Conversation::find($conversation_id);
        $receiver = UserInfo::find($conversation->receiver_id);
        $sender = UserInfo::find($conversation->sender_id);
        $user = UserInfo::find($user_id);
        return response()->json([
            'view' => view('admin-views.market.view.partials._conversations', compact('convs', 'user', 'receiver'))->render()
        ]);
    }

    public function cash_transaction_export(Request $request)
    {
        try {
            $transaction = AccountTransaction::where('from_type', 'market')->where('type', 'collected')->where('from_id', $request->market)->get();
            $data = [
                'data' => $transaction,
                'search' => $request['search'] ?? null,
            ];
            if ($request->type == 'csv') {
                return Excel::download(new marketWiseCashCollectionExport($data), 'CashTransaction.csv');
            }
            return Excel::download(new marketWiseCashCollectionExport($data), 'CashTransaction.xlsx');
        } catch (\Exception $e) {
            Toastr::error("line___{$e->getLine()}", $e->getMessage());
            info(["line___{$e->getLine()}", $e->getMessage()]);
            return back();
        }
    }

    public function digital_transaction_export(Request $request)
    {
        try {
            $transaction = OrderTransaction::where('vendor_id', $request->market)->latest()->get();

            $data = [
                'data' => $transaction,
                'search' => $request['search'] ?? null,
            ];
            if ($request->type == 'csv') {
                return Excel::download(new marketWiseWithdrawOrderTransactionExport($data), 'AdminOrderTransaction.csv');
            }
            return Excel::download(new marketWiseWithdrawOrderTransactionExport($data), 'AdminOrderTransaction.xlsx');
        } catch (\Exception $e) {
            Toastr::error("line___{$e->getLine()}", $e->getMessage());
            info(["line___{$e->getLine()}", $e->getMessage()]);
            return back();
        }
    }

    public function withdraw_transaction_export(Request $request)
    {
        try {
            $withdraw_transaction = WithdrawRequest::where('vendor_id', $request->market)->get();
            $data = [
                'data' => $withdraw_transaction,
                'search' => $request['search'] ?? null,
            ];
            if ($request->type == 'csv') {
                return Excel::download(new marketWiseWithdrawTransactionExport($data), 'WithdrawTransaction.csv');
            }
            return Excel::download(new marketWiseWithdrawTransactionExport($data), 'WithdrawTransaction.xlsx');
        } catch (\Exception $e) {
            Toastr::error("line___{$e->getLine()}", $e->getMessage());
            info(["line___{$e->getLine()}", $e->getMessage()]);
            return back();
        }
    }



    public function withdraw_search(Request $request)
    {
        $key = explode(' ', $request['search']);
        $withdraw_req = WithdrawRequest::whereHas('market', function ($query) use ($key) {
            $query->whereHas('markets', function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->where('name', 'like', "%{$value}%");
                }
            });
        })->get();

        return response()->json([
            'view' => view('admin-views.wallet.partials._table', compact('withdraw_req'))->render(),
            'total' => $withdraw_req?->count()
        ]);
    }


    public function markets_export(Request $request,  $type)
    {
        try {
            $key = explode(' ', $request['search']);
            $zone_id = $request->query('zone_id', 'all');
            $cuisine_id = $request->query('cuisine_id', 'all');
            $type = $request->query('type', 'all');
            $typ = $request->query('market_model', null);
            $markets = Market::when(is_numeric($zone_id), function ($query) use ($zone_id) {
                return $query->where('zone_id', $zone_id);
            })
                ->with(['zone', 'cuisine', 'market'])
                ->withSum('reviews', 'rating')
                ->withCount('reviews', 'foods')
                ->whereHas('market', function ($q) {
                    $q->where('status', 1);
                })
                ->when(isset($key), function ($q) use ($key) {
                    $q->where(function ($query) use ($key) {
                        $query->orWhereHas('market', function ($q) use ($key) {
                            foreach ($key as $value) {
                                $q->orWhere('f_name', 'like', "%{$value}%")
                                    ->orWhere('l_name', 'like', "%{$value}%")
                                    ->orWhere('email', 'like', "%{$value}%")
                                    ->orWhere('phone', 'like', "%{$value}%");
                            }
                        })
                            ->where(function ($q) use ($key) {
                                foreach ($key as $value) {
                                    $q->orWhere('name', 'like', "%{$value}%")
                                        ->orWhere('email', 'like', "%{$value}%")
                                        ->orWhere('phone', 'like', "%{$value}%");
                                }
                            });
                    });
                })
                ->cuisine($cuisine_id)
                ->type($type)->marketModel($typ)->latest()->get();


            $data = [
                'data' => $markets,
                'zone' => is_numeric($zone_id) ? Helpers::get_zones_name($zone_id) : null,
                'search' => $request['search'] ?? null,
                'model' => $typ ?? null,
                'type' => $type ?? null,
                'cuisine' => is_numeric($cuisine_id) ? Cuisine::where('id', $cuisine_id)->first()?->name : null,

            ];
            if ($request->type == 'csv') {
                return Excel::download(new marketListExport($data), 'markets.csv');
            }
            return Excel::download(new marketListExport($data), 'markets.xlsx');
        } catch (\Exception $e) {
            Toastr::error("line___{$e->getLine()}", $e->getMessage());
            info(["line___{$e->getLine()}", $e->getMessage()]);
            return back();
        }
    }

    public function market_wise_reviwe_export(Request $request)
    {
        try {
            $market = Market::where('id', $request->id)->first();
            $reviews = $market->reviews()->with('food', function ($query) {
                $query->withoutGlobalScope(\App\Scopes\marketScope::class);
            })->get();

            $user_rating = null;
            $total_rating = 0;
            $total_reviews = 0;
            foreach ($reviews as $key => $value) {
                $user_rating += $value->rating;
                $total_rating += 1;
                $total_reviews += 1;
            }
            $user_rating = isset($user_rating) ? ($user_rating) / count($reviews) : 0;
            $data = [
                'market_name' => $market->name,
                'market_id' => $market->id,
                'rating' => number_format($user_rating, 1),
                'total_reviews' => $total_reviews,
                'data' => $reviews
            ];
            if ($request->type == 'csv') {
                return Excel::download(new RestauranrWiseFoodReviewExport($data), 'marketWiseFoodReview.csv');
            }
            return Excel::download(new RestauranrWiseFoodReviewExport($data), 'marketWiseFoodReview.xlsx');
        } catch (\Exception $e) {
            Toastr::error("line___{$e->getLine()}", $e->getMessage());
            info(["line___{$e->getLine()}", $e->getMessage()]);
            return back();
        }
    }


    public function withdraw_list_export(Request $request)
    {
        try {
            $key = isset($request['search']) ? explode(' ', $request['search']) : [];

            $all = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'all' ? 1 : 0;
            $active = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'approved' ? 1 : 0;
            $denied = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'denied' ? 1 : 0;
            $pending = session()->has('withdraw_status_filter') && session('withdraw_status_filter') == 'pending' ? 1 : 0;

            $withdraw_req = WithdrawRequest::with(['market'])
                ->when($all, function ($query) {
                    return $query;
                })
                ->when($active, function ($query) {
                    return $query->where('approved', 1);
                })
                ->when($denied, function ($query) {
                    return $query->where('approved', 2);
                })
                ->when($pending, function ($query) {
                    return $query->where('approved', 0);
                })
                ->when(isset($key), function ($query) use ($key) {
                    return $query->whereHas('market', function ($query) use ($key) {
                        $query->whereHas('markets', function ($q) use ($key) {
                            foreach ($key as $value) {
                                $q->where('name', 'like', "%{$value}%");
                            }
                        });
                    });
                })
                ->latest()
                ->get();
            $data = [
                'withdraw_requests' => $withdraw_req,
                'search' => $request->search ?? null,
                'request_status' => session()->has('withdraw_status_filter') ? session('withdraw_status_filter') : null,

            ];

            if ($request->type == 'excel') {
                return Excel::download(new marketWithdrawTransactionExport($data), 'WithdrawRequests.xlsx');
            } else if ($request->type == 'csv') {
                return Excel::download(new marketWithdrawTransactionExport($data), 'WithdrawRequests.csv');
            }
        } catch (\Exception $e) {
            Toastr::error("line___{$e->getLine()}", $e->getMessage());
            info(["line___{$e->getLine()}", $e->getMessage()]);
            return back();
        }
    }
    public function disbursement_export(Request $request, $id, $type)
    {
        $key = explode(' ', $request['search']);

        $market = Market::find($id);
        $disbursements = DisbursementDetails::where('market_id', $market->id)
            ->when(isset($key), function ($q) use ($key) {
                $q->where(function ($q) use ($key) {
                    foreach ($key as $value) {
                        $q->orWhere('disbursement_id', 'like', "%{$value}%")
                            ->orWhere('status', 'like', "%{$value}%");
                    }
                });
            })
            ->latest()->get();
        $data = [
            'disbursements' => $disbursements,
            'search' => $request->search ?? null,
            'market' => $market->name,
            'type' => 'market',
        ];

        if ($request->type == 'excel') {
            return Excel::download(new DisbursementHistoryExport($data), 'Disbursementlist.xlsx');
        } else if ($request->type == 'csv') {
            return Excel::download(new DisbursementHistoryExport($data), 'Disbursementlist.csv');
        }
    }
    public function updateStoreMetaData(Market $market, Request $request)
    {
        $request->validate([
            'meta_title.0' => 'required',
            'meta_title.*' => 'max:100',
            'meta_description.0' => 'required',
        ], [
            'meta_title.0.required' => translate('default_meta_title_is_required'),
            'meta_description.0.required' => translate('default_meta_description_is_required'),
            'meta_title.max' => translate('Title_must_be_within_100_character'),
        ]);

        $market->meta_image = $request->has('meta_image') ? Helpers::update('market/', $market->meta_image, 'png', $request->file('meta_image')) : $market->meta_image;
        $market->meta_title = $request->meta_title[array_search('default', $request->lang)];
        $market->meta_description = $request->meta_description[array_search('default', $request->lang)];
        $market->save();

        Helpers::add_or_update_translations(request: $request, key_data: 'meta_title', name_field: 'meta_title', model_name: 'Market', data_id: $market->id, data_value: $market->meta_title);
        Helpers::add_or_update_translations(request: $request, key_data: 'meta_description', name_field: 'meta_description', model_name: 'Market', data_id: $market->id, data_value: $market->meta_description);

        Toastr::success(translate('messages.meta_data_updated'));
        return back();
    }

    public function qr_store(Market $market, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'phone' => 'required',
            'website' => 'required'
        ]);


        $data = [];

        $data['title'] = $request->title;
        $data['description'] = $request->description;
        $data['phone'] = $request->phone;
        $data['website'] = $request->website;

        $market->qr_code = json_encode($data);
        $market->save();

        Toastr::success(translate('updated successfully'));
        return back();
    }

    public function download_pdf(Market $market)
    {
        $data = json_decode($market->qr_code, true);
        $code = isset($data) ? QrCode::size(180)->generate(json_encode($data)) : '';
        //        $mpdf_view = View::make('admin-views.market.view.qrcode-pdf', compact('market','data','code')
        //        );
        //        Helpers::gen_mpdf(view: $mpdf_view,file_prefix: 'qr-code' . rand(00001, 99999),file_postfix: $market->id);
        $pdf = PDF::loadView('admin-views.market.view.qrcode-pdf', compact('market', 'data', 'code'))->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('qr-code' . rand(00001, 99999) . '.pdf');
    }

    public function print_qrcode(Market $market)
    {
        $data = json_decode($market->qr_code, true);
        $code = isset($data) ? QrCode::size(180)->generate(json_encode($data)) : '';
        return view('admin-views.market.view.qrcode-print', compact('market', 'data', 'code'));
    }
}
