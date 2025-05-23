@extends('layouts.admin.app')

@section('title', $restaurant->name)

@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{ dynamicAsset('public/assets/admin/css/croppie.css') }}" rel="stylesheet">
    <style>
        .sortable-placeholder {
            background-color: #f0f0f0;
            border: 1px dashed #ccc;
            height: 100px;
            /* Adjust height to match your elements */
            margin: 10px 0;
        }
    </style>
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <h1 class="page-header-title text-break me-2">
                    <i class="tio-shop"></i> <span>{{ $restaurant->name }}</span>
                </h1>
                <a href="javascript:void(0)" id="SaveSort" class="btn btn-success my-2">
                    <i class="tio-file mr-2"></i> {{ translate('messages.save ordering') }}
                </a>
                <a href="{{ route('admin.restaurant.create_category_page', $restaurant->id) }}"
                    class="btn btn--primary my-2">
                    <i class="tio-edit mr-2"></i> {{ translate('messages.add_new_category') }}
                </a>




            </div>

        </div>
        <!-- End Page Header -->
        <!-- Page Heading -->
        <div class="content container-fluid">
            @foreach ($categories as $category)
                <div class="drg">
                    <div class="page-header d-flex justify-content-between">
                        <h1 class="page-header-title">

                            <span>{{ $category->name }}</span>
                        </h1>



                        <hr>
                    </div>
                    <div class="disbursement-report mb-20">

                        @foreach ($category->Foods as $food)
                            <div class="__card-3 food rebursement-item" data-id="{{ $food->id }}">
                                <div class="info-icon" data-toggle="tooltip" data-placement="top"
                                    data-original-title="All the pending disbursement requests that require admin’s action (complete/cancel)."
                                    aria-describedby="tooltip624691">
                                    <img src="http://127.0.0.1:8000/assets/admin/img/report/new/info1.png" alt="report/new">
                                </div>
                                <img class="icon"
                                    src="{{ \App\CentralLogics\Helpers::onerror_image_helper(
                                        $food['image'] ?? '',
                                        dynamicStorage('storage/app/public/product') . '/' . $food['image'] ?? '',
                                        dynamicAsset('public/assets/admin/img/100x100/food-default-image.png'),
                                        'product/',
                                    ) }}"
                                    data-onerror-image="{{ dynamicAsset('public/assets/admin/img/100x100/food-default-image.png') }}"
                                    alt="{{ $food->name }} image">

                                <h6 class="subtitle">{{ $food->name }}</h6>
                                <hr>
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="btn--container">
                                        <label class="toggle-switch toggle-switch-sm ml-2 sts-fld"
                                            data-url="{{ route('admin.food.status', [$food['id'], $food->status ? 0 : 1]) }}"
                                            for="stocksCheckbox{{ $food->id }}">
                                            <input type="checkbox" class="toggle-switch-input"
                                                id="stocksCheckbox{{ $food->id }}"
                                                {{ $food->status ? 'checked' : '' }}>
                                            <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </div>

                                    <div class="btn--container">
                                        <a class="btn btn-sm btn--primary btn-outline-primary action-btn"
                                            href="{{ route('admin.food.edit', [$food['id']]) }}"
                                            title="{{ translate('messages.edit_food') }}"><i class="tio-edit"></i>
                                        </a>
                                        <a class="btn btn-sm btn--danger btn-outline-danger action-btn form-alert"
                                            href="javascript:" data-id="food-{{ $food['id'] }}"
                                            data-message="{{ translate('Want_to_delete_this_food_?') }}"
                                            title="{{ translate('messages.delete_food') }}"><i
                                                class="tio-delete-outlined"></i>
                                        </a>
                                    </div>
                                    <div class="btn--container">

                                        <form action="{{ route('admin.food.delete', [$food['id']]) }}" method="post"
                                            id="food-{{ $food['id'] }}">
                                            @csrf @method('delete')
                                        </form>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                        <div data-categoryId="{{ $category->id }}" class="__card-3 rebursement-item add_new"
                            data-toggle="modal" data-target="#addSystemModal">
                            <div class="info-icon" data-toggle="tooltip" data-placement="top"
                                data-original-title="All the pending disbursement requests that require admin’s action (complete/cancel)."
                                aria-describedby="tooltip624691">
                                <img src="http://127.0.0.1:8000/assets/admin/img/report/new/info1.png" alt="report/new">
                            </div>
                            <img class="icon"
                                src="https://assets.dryicons.com/uploads/icon/svg/12629/b1694dd4-c66a-40d0-8f95-bdd8131494be.svg"
                                data-onerror-image="https://assets.dryicons.com/uploads/icon/svg/12629/b1694dd4-c66a-40d0-8f95-bdd8131494be.svg"
                                alt=" image">
                            <h6 class="subtitle">{{ translate('messages.add_new') }}</h6>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Modal -->
        <div class="modal fade " id="addSystemModal" tabindex="-1">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title" id="exampleModalLabel">{{ translate('messages.Food_Setup') }} </h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-30">

                        <!-- End Page Header -->
                        <form action="javascript:" method="post" id="food_form" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-2">
                                <div class="col-lg-6">
                                    <div class="card shadow--card-2 border-0">
                                        <div class="card-body pb-0">
                                            @php($language = \App\Models\BusinessSetting::where('key', 'language')->first())
                                            @php($language = $language->value ?? null)
                                            @php($default_lang = str_replace('_', '-', app()->getLocale()))
                                            @if ($language)
                                                <ul class="nav nav-tabs mb-4">
                                                    <li class="nav-item">
                                                        <a class="nav-link lang_link active" href="#"
                                                            id="default-link">{{ translate('Default') }}</a>
                                                    </li>
                                                    @foreach (json_decode($language) as $lang)
                                                        <li class="nav-item">
                                                            <a class="nav-link lang_link " href="#"
                                                                id="{{ $lang }}-link">{{ \App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')' }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                        @if ($language)
                                            <div class="card-body">

                                                <div class="lang_form" id="default-form">


                                                    <div class="form-group">
                                                        <label class="input-label"
                                                            for="default_name">{{ translate('messages.name') }}
                                                            ({{ translate('Default') }}) <span
                                                                class="form-label-secondary text-danger"
                                                                data-toggle="tooltip" data-placement="right"
                                                                data-original-title="{{ translate('messages.Required.') }}">
                                                                *
                                                            </span>
                                                        </label>
                                                        <input type="text" name="name[]" id="default_name"
                                                            class="form-control"
                                                            placeholder="{{ translate('messages.new_food') }}">
                                                    </div>
                                                    <input type="hidden" name="lang[]" value="default">
                                                    <div class="form-group mb-0">
                                                        <label class="input-label"
                                                            for="exampleFormControlInput1">{{ translate('messages.short_description') }}
                                                            ({{ translate('Default') }}) <span
                                                                class="form-label-secondary text-danger"
                                                                data-toggle="tooltip" data-placement="right"
                                                                data-original-title="{{ translate('messages.Required.') }}">
                                                                *
                                                            </span></label>
                                                        <textarea type="text" name="description[]" class="form-control ckeditor min-height-154px"></textarea>
                                                    </div>
                                                </div>

                                                @foreach (json_decode($language) as $lang)
                                                    <div class="d-none lang_form" id="{{ $lang }}-form">
                                                        <div class="form-group">
                                                            <label class="input-label"
                                                                for="{{ $lang }}_name">{{ translate('messages.name') }}
                                                                ({{ strtoupper($lang) }})
                                                            </label>
                                                            <input type="text" name="name[]"
                                                                id="{{ $lang }}_name" class="form-control"
                                                                placeholder="{{ translate('messages.new_food') }}">
                                                        </div>
                                                        <input type="hidden" name="lang[]"
                                                            value="{{ $lang }}">
                                                        <div class="form-group mb-0">
                                                            <label class="input-label"
                                                                for="exampleFormControlInput1">{{ translate('messages.short_description') }}
                                                                ({{ strtoupper($lang) }})</label>
                                                            <textarea type="text" name="description[]" class="form-control ckeditor min-height-154px"></textarea>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="card-body">
                                                <div id="default-form">
                                                    <div class="form-group">
                                                        <label class="input-label"
                                                            for="exampleFormControlInput1">{{ translate('messages.name') }}
                                                            ({{ translate('Default') }})</label>
                                                        <input type="text" name="name[]" class="form-control"
                                                            placeholder="{{ translate('messages.new_food') }}">
                                                    </div>
                                                    <input type="hidden" name="lang[]" value="default">
                                                    <div class="form-group mb-0">
                                                        <label class="input-label"
                                                            for="exampleFormControlInput1">{{ translate('messages.short_description') }}</label>
                                                        <textarea type="text" name="description[]" class="form-control ckeditor min-height-154px"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card shadow--card-2 border-0 h-100">
                                        <div class="card-body">
                                            <div class="d-flex flex-column align-items-center gap-3">
                                                <p class="mb-0">{{ translate('Food_Image') }}</p>

                                                <div class="image-box">
                                                    <label for="image-input"
                                                        class="d-flex flex-column align-items-center justify-content-center h-100 cursor-pointer gap-2">
                                                        <img width="30" class="upload-icon"
                                                            src="{{ asset('public/assets/admin/img/upload-icon.png') }}"
                                                            alt="Upload Icon">
                                                        <span class="upload-text">{{ translate('Upload Image') }}</span>
                                                        <img src="#" alt="Preview Image" class="preview-image">
                                                    </label>
                                                    <button type="button" class="delete_image">
                                                        <i class="tio-delete"></i>
                                                    </button>
                                                    <input type="file" id="image-input" name="image"
                                                        accept="image/*" hidden>
                                                </div>

                                                <p class="opacity-75 max-w220 mx-auto text-center">
                                                    {{ translate('Image format - jpg png jpeg gif Image Size -maximum size 2 MB Image Ratio - 1:1') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="card shadow--card-2 border-0">
                                        <div class="card-header">
                                            <h5 class="card-title">
                                                <span class="card-header-icon mr-2">
                                                    <i class="tio-dashboard-outlined"></i>
                                                </span>
                                                <span> {{ translate('Restaurants_&_Category_Info') }}</span>
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-2">
                                                {{-- <div class="col-sm-6 col-lg-3"> --}}
                                                <input name="restaurant_id" hidden value="{{ $restaurant->id }}" />
                                                {{-- </div> --}}
                                                <input name="category_id" hidden value="{{ $restaurant->id }}" />
                                                {{-- <div class="col-sm-6 col-lg-3">

                                                    <div class="form-group mb-0">
                                                        <label class="input-label"
                                                            for="exampleFormControlSelect1">{{ translate('messages.category') }}<span
                                                                class="form-label-secondary text-danger"
                                                                data-toggle="tooltip" data-placement="right"
                                                                data-original-title="{{ translate('messages.Required.') }}">
                                                                *
                                                            </span></label>
                                                        <select name="category_id" id="category_id"
                                                            class="form-control js-select2-custom get-request"
                                                            oninvalid="this.setCustomValidity('Select Category')">
                                                            <option value="" selected disabled>
                                                                {{ translate('Select_Category') }}</option>
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category['id'] }}">
                                                                    {{ $category['name'] }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div> --}}

                                                <div class="col-sm-6 col-lg-3">
                                                    <div class="form-group mb-0">
                                                        <label class="input-label"
                                                            for="exampleFormControlInput1">{{ translate('messages.food_type') }}<span
                                                                class="form-label-secondary text-danger"
                                                                data-toggle="tooltip" data-placement="right"
                                                                data-original-title="{{ translate('messages.Required.') }}">
                                                                *
                                                            </span></label>
                                                        <select name="veg" id="veg"
                                                            class="form-control js-select2-custom">
                                                            <option value="" selected disabled>
                                                                {{ translate('Select_Preferences') }}</option>
                                                            <option value="0">{{ translate('messages.non_veg') }}
                                                            </option>
                                                            <option value="1">{{ translate('messages.veg') }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-lg-3" id="halal">
                                                    <div class="form-check mb-0 p-4">
                                                        <input class="form-check-input" name="is_halal" type="checkbox"
                                                            value="1" id="flexCheckDefault" checked>
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            {{ translate('messages.Is_Pizza_Meal') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card shadow--card-2 border-0">
                                        <div class="card-header">
                                            <h5 class="card-title">
                                                <span class="card-header-icon mr-2">
                                                    <i class="tio-dashboard-outlined"></i>
                                                </span>
                                                <span>{{ translate('messages.addon') }}</span>
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <label class="input-label"
                                                for="exampleFormControlSelect1">{{ translate('Select_Add-on') }}<span
                                                    class="input-label-secondary" data-toggle="tooltip"
                                                    data-placement="right"
                                                    data-original-title="{{ translate('messages.The_selected_addon’s_will_be_displayed_in_this_food_details') }}"><img
                                                        src="{{ dynamicAsset('/public/assets/admin/img/info-circle.svg') }}"
                                                        alt="{{ translate('messages.The_selected_addon’s_will_be_displayed_in_this_food_details') }}"></span></label>
                                            <select name="addon_ids[]" class="form-control border js-select2-custom"
                                                multiple="multiple" id="add_on">

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card shadow--card-2 border-0">
                                        <div class="card-header">
                                            <h5 class="card-title">
                                                <span class="card-header-icon mr-2"><i class="tio-date-range"></i></span>
                                                <span>{{ translate('messages.Availability') }}</span>
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-2">
                                                <div class="col-sm-6">
                                                    <div class="form-group mb-0">
                                                        <label class="input-label"
                                                            for="exampleFormControlInput1">{{ translate('messages.available_time_starts') }}<span
                                                                class="form-label-secondary text-danger"
                                                                data-toggle="tooltip" data-placement="right"
                                                                data-original-title="{{ translate('messages.Required.') }}">
                                                                *
                                                            </span></label>
                                                        <input type="time" name="available_time_starts"
                                                            class="form-control" id="available_time_starts"
                                                            placeholder="{{ translate('messages.Ex:_10:30_am') }} "
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group mb-0">
                                                        <label class="input-label"
                                                            for="exampleFormControlInput1">{{ translate('messages.available_time_ends') }}<span
                                                                class="form-label-secondary text-danger"
                                                                data-toggle="tooltip" data-placement="right"
                                                                data-original-title="{{ translate('messages.Required.') }}">
                                                                *
                                                            </span></label>
                                                        <input type="time" name="available_time_ends"
                                                            class="form-control" id="available_time_ends"
                                                            placeholder="5:45 pm" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="card shadow--card-2 border-0">
                                        <div class="card-header">
                                            <h5 class="card-title">
                                                <span class="card-header-icon mr-2"><i
                                                        class="tio-dollar-outlined"></i></span>
                                                <span>{{ translate('Price_Information') }}</span>
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-2">
                                                <div class="col-md-3">
                                                    <div class="form-group mb-0">
                                                        <label class="input-label"
                                                            for="exampleFormControlInput1">{{ translate('messages.Unit_Price') }}
                                                            {{ \App\CentralLogics\Helpers::currency_symbol() }}<span
                                                                class="form-label-secondary text-danger"
                                                                data-toggle="tooltip" data-placement="right"
                                                                data-original-title="{{ translate('messages.Required.') }}">
                                                                *
                                                            </span></label>
                                                        <input type="number" min="0" max="999999999999.999"
                                                            step="0.001" value="1" name="price"
                                                            class="form-control"
                                                            placeholder="{{ translate('messages.Ex:_100') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-0">
                                                        <label class="input-label"
                                                            for="exampleFormControlInput1">{{ translate('messages.discount_type') }}

                                                        </label>
                                                        <select name="discount_type"
                                                            class="form-control js-select2-custom">
                                                            <option value="percent">
                                                                {{ translate('messages.percent') . ' (%)' }}</option>
                                                            <option value="amount">
                                                                {{ translate('messages.amount') . ' (' . \App\CentralLogics\Helpers::currency_symbol() . ')' }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-0">
                                                        <label class="input-label"
                                                            for="exampleFormControlInput1">{{ translate('messages.discount') }}
                                                            <span class="form-label-secondary text-danger"
                                                                data-toggle="tooltip" data-placement="right"
                                                                data-original-title="{{ translate('messages.Required.') }}">
                                                                *
                                                            </span>
                                                            <span class="input-label-secondary text--title"
                                                                data-toggle="tooltip" data-placement="right"
                                                                data-original-title="{{ translate('Currently_you_need_to_manage_discount_with_the_Restaurant.') }}">
                                                                <i class="tio-info-outined"></i>
                                                            </span>
                                                        </label>
                                                        <input type="number" min="0" max="999999999999999"
                                                            value="0" name="discount" class="form-control"
                                                            placeholder="{{ translate('messages.Ex:_100') }} ">
                                                    </div>
                                                </div>
                                                <div class="col-md-3" id="maximum_cart_quantity">
                                                    <div class="form-group mb-0">
                                                        <label class="input-label"
                                                            for="maximum_cart_quantity">{{ translate('messages.Maximum_Purchase_Quantity_Limit') }}
                                                            <span class="input-label-secondary text--title"
                                                                data-toggle="tooltip" data-placement="right"
                                                                data-original-title="{{ translate('If_this_limit_is_exceeded,_customers_can_not_buy_the_food_in_a_single_purchase.') }}">
                                                                <i class="tio-info-outined"></i>
                                                            </span>
                                                        </label>
                                                        <input type="number"
                                                            placeholder="{{ translate('messages.Ex:_10') }}"
                                                            class="form-control" name="maximum_cart_quantity"
                                                            min="0" id="cart_quantity">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group mb-0">
                                                        <label class="input-label"
                                                            for="exampleFormControlInput1">{{ translate('messages.Stock_Type') }}
                                                        </label>
                                                        <select name="stock_type" id="stock_type"
                                                            class="form-control js-select2-custom">
                                                            <option value="unlimited">
                                                                {{ translate('messages.Unlimited_Stock') }}</option>
                                                            <option value="limited">
                                                                {{ translate('messages.Limited_Stock') }}</option>
                                                            <option value="daily">{{ translate('messages.Daily_Stock') }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 hide_this" id="">
                                                    <div class="form-group mb-0">
                                                        <label class="input-label"
                                                            for="item_stock">{{ translate('messages.Item_Stock') }}
                                                            <span class="input-label-secondary text--title"
                                                                data-toggle="tooltip" data-placement="right"
                                                                data-original-title="{{ translate('This_Stock_amount_will_be_counted_as_the_base_stock._But_if_you_want_to_manage_variation_wise_stock,_then_need__to_manage_it_below_with_food_variation_setup.') }}">
                                                                <i class="tio-info-outined"></i>
                                                            </span>
                                                        </label>
                                                        <input type="number"
                                                            placeholder="{{ translate('messages.Ex:_10') }}"
                                                            class="form-control stock_disable" name="item_stock"
                                                            min="0" max="999999999" id="item_stock">
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="card shadow--card-2 border-0">
                                        <div class="card-header flex-wrap">
                                            <h5 class="card-title">
                                                <span class="card-header-icon mr-2">
                                                    <i class="tio-canvas-text"></i>
                                                </span>
                                                <span>{{ translate('messages.food_variations') }}</span>
                                            </h5>
                                            <a class="btn text--primary-2" id="add_new_option_button">
                                                {{ translate('add_new_variation') }}
                                                <i class="tio-add"></i>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-2">
                                                <div class="col-md-12">
                                                    <div id="add_new_option">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="card shadow--card-2 border-0">
                                        <div class="card-header">
                                            <h5 class="card-title">
                                                <span class="card-header-icon mr-2"><i class="tio-label"></i></span>
                                                <span>{{ translate('tags') }}</span>
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <input type="text" class="form-control" name="tags"
                                                placeholder="Enter tags" data-role="tagsinput">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="btn--container justify-content-end">
                                        <button type="reset" id="reset_btn"
                                            class="btn btn--reset">{{ translate('messages.reset') }}</button>
                                        <button type="submit"
                                            class="btn btn--primary">{{ translate('messages.submit') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="mt-4">
            <div id="restaurant_details" class="row g-3">
               
                    <div class="col-lg-6">
                        <div class="card h-100">

                            <div class="card-body d-flex flex-column justify-content-center">
                                <div class="resturant--info-address">
                                    <div class="avatar avatar-xxl avatar-circle avatar-border-lg">
                                        <img class="avatar-img onerror-image"
                                            data-onerror-image="{{ dynamicAsset('public/assets/admin/img/160x160/img1.jpg') }}"
                                            src="{{\App\CentralLogics\Helpers::onerror_image_helper($category['image'], dynamicStorage('storage/app/public/category/').'/'.$category['image'], dynamicAsset('/public/assets/admin/img/900x400/img1.jpg'), 'category/') }}"
                                            alt="Image Description">
                                    </div>
                                    <ul class="address-info address-info-2 list-unstyled list-unstyled-py-3 text-dark">
                                        <li>
                                            <h5 class="name">
                                                {{ $category->title }}
                                            </h5>
                                        </li>
                                        <li>
                                            <i class="tio-call-talking nav-icon"></i>
                                            <span class="pl-1">
                                                {{ $category->food_count }}
                                            </span>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                


              
               
            </div>



         

        </div> --}}
    </div>
    </div>
@endsection

@push('script_2')
    <script src="{{ dynamicAsset('public/assets/admin') }}/js/tags-input.min.js"></script>
    <script src="{{ dynamicAsset('public/assets/admin/js/spartan-multi-image-picker.js') }}"></script>
    <script src="{{ dynamicAsset('public/assets/admin') }}/js/view-pages/product-index.js"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ \App\Models\BusinessSetting::where('key', 'map_api_key')->first()->value }}&callback=initMap&v=3.45.8">
    </script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"
      integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
     integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA=="
     crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- <script src="https://code.jquery.com/ui/1.14.0-beta.1/jquery-ui.min.js"
        integrity="sha256-eTkBotE66yiuQ4Th2m+9M00ivksRSCZHIphWprTOFls=" crossorigin="anonymous"></script> --}}
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"
        integrity="sha512-HWlJyU4ut5HkEj0QsK/IxBCY55n5ZpskyjVlAoV9Z7XQwwkqXoYdCIC93/htL3Gu5H3R4an/S0h2NXfbZk3g7w=="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // $(".content").sortable({
            //     items: ".drg",
            //     cursor: "move",
            //     placeholder: "sortable-placeholder",
            //     start: function(event, ui) {
            //         ui.placeholder.height(ui.item.height());
            //     },
            //     update: function(event, ui) {
            //         // Get the new order of the elements
            //         let sortedIDs = $(this).sortable("toArray", {
            //             attribute: "data-category-id"
            //         });

            //         toastr.success('{{ translate('messages.updated_successfully!') }}', {
            //             CloseButton: true,
            //             ProgressBar: true
            //         });
            //         // AJAX request
            //         // $.ajax({
            //         //     url: '/your-endpoint-here', // Replace with your URL
            //         //     method: 'POST',
            //         //     data: {
            //         //         sortedIDs: sortedIDs,
            //         //         _token: '{{ csrf_token() }}' // Include CSRF token if needed
            //         //     },
            //         //     success: function(response) {
            //         //         // Handle success
            //         //         console.log("Order updated successfully!");
            //         //     },
            //         //     error: function(xhr, status, error) {
            //         //         // Handle error
            //         //         console.error("Error updating order:", error);
            //         //     }
            //         // });

            //         console.log("Order updated successfully!");
            //     }
            // });




            var order = [];
            $(".content").sortable({
                items: ".food",
                cursor: "move",
                placeholder: "sortable-placeholder",
                start: function(event, ui) {
                    ui.placeholder.height(ui.item.height());
                },
                update: function(event, ui) {


                    $('.content .food').each(function(index, element) {
                        order.push({
                            id: $(element).data('id'),
                            position: index + 1
                        });
                    });




                    console.log("Food updated successfully!");
                }
            });


            $('#SaveSort').on('click', function() {
                console.log(order);
                $.ajax({
                    url: '/update-food-order',
                    method: 'POST',
                    data: {
                        order: order,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                    }
                });


                toastr.success('{{ translate('messages.updated_successfully!') }}', {
                    CloseButton: true,
                    ProgressBar: true
                });
            })
        });
    </script>

   


    <script>
        "use strict";
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        const myLatLng = {
            lat: {{ $restaurant->latitude }},
            lng: {{ $restaurant->longitude }}
        };
        let map;
        initMap();

        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: myLatLng,
            });
            new google.maps.Marker({
                position: myLatLng,
                map,
                title: "{{ $restaurant->name }}",
            });
        }

        $(document).on('ready', function() {
            // INITIALIZATION OF DATATABLES
            // =======================================================
            let datatable = $.HSCore.components.HSDatatables.init($('#columnSearchDatatable'));

            $('#column1_search').on('keyup', function() {
                datatable
                    .columns(1)
                    .search(this.value)
                    .draw();
            });

            $('#column2_search').on('keyup', function() {
                datatable
                    .columns(2)
                    .search(this.value)
                    .draw();
            });

            $('#column3_search').on('change', function() {
                datatable
                    .columns(3)
                    .search(this.value)
                    .draw();
            });

            $('#column4_search').on('keyup', function() {
                datatable
                    .columns(4)
                    .search(this.value)
                    .draw();
            });


            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function() {
                let select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });

        $('.request_alert').on('click', function(event) {
            let url = $(this).data('url');
            let message = $(this).data('message');
            request_alert(url, message)
        })

        function request_alert(url, message) {
            Swal.fire({
                title: "{{ translate('messages.are_you_sure_?') }}",
                text: message,
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '#FC6A57',
                cancelButtonText: "{{ translate('messages.no') }}",
                confirmButtonText: "{{ translate('messages.yes') }}",
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    location.href = url;
                }
            })
        }
    </script>




    <script>
        "use strict";
        $('#stock_type').on('change', function() {
            if ($(this).val() == 'unlimited') {
                $('.stock_disable').prop('readonly', true).prop('required', false).attr('placeholder',
                    '{{ translate('Unlimited') }}').val('');
                $('.hide_this').addClass('d-none');
            } else {
                $('.stock_disable').prop('readonly', false).prop('required', true).attr('placeholder',
                    '{{ translate('messages.Ex:_100') }}');
                $('.hide_this').removeClass('d-none');
                // if($('.view_new_option').length > 0){
                //     $('#item_stock').prop('readonly', true).prop('required', false);
                // }
            }
        });

        updatestockCount();

        function updatestockCount() {
            if ($('#stock_type').val() == 'unlimited') {
                $('.stock_disable').prop('readonly', true).prop('required', false).attr('placeholder',
                    '{{ translate('Unlimited') }}').val('');
                $('.hide_this').addClass('d-none');
            } else {
                $('.stock_disable').prop('readonly', false).prop('required', true).attr('placeholder',
                    '{{ translate('messages.Ex:_100') }}');
                $('.hide_this').removeClass('d-none');
            }
            // if($('.view_new_option').length > 0){
            //     $('#item_stock').prop('readonly', true).prop('required', false);
            // }


            // $(".count_stock").on('input', function() {
            //     var sum = 0;
            //     $(".count_stock").each(function() {
            //         const value = parseFloat($(this).val()) || 0;
            //         sum += value;
            //     });
            //     $("#item_stock").val(sum);
            // });


        }
        $(document).ready(function() {
            let count = 0;
            $("#add_new_option_button").click(function(e) {
                $('#empty-variation').hide();
                count++;
                let add_option_view = `
                    <div class="__bg-F8F9FC-card view_new_option mb-2">
                        <div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <label class="form-check form--check">
                                    <input id="options[` + count + `][required]" name="options[` + count + `][required]" class="form-check-input" type="checkbox">
                                    <span class="form-check-label">{{ translate('Required') }}</span>
                                </label>
                                <div>
                                    <button type="button" class="btn btn-danger btn-sm delete_input_button"
                                        title="{{ translate('Delete') }}">
                                        <i class="tio-add-to-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-xl-4 col-lg-6">
                                    <label for="">{{ translate('name') }}&nbsp;<span class="form-label-secondary text-danger"
                                data-toggle="tooltip" data-placement="right"
                                data-original-title="{{ translate('messages.Required.') }}"> *
                                </span></label>
                                <select class="form-control">
                                    
                                </select>
                                   
                                </div>

                                <div class="col-xl-4 col-lg-6">
                                    <div>
                                        <label class="input-label text-capitalize d-flex align-items-center"><span class="line--limit-1">{{ translate('messages.Variation_Selection_Type') }} </span>
                                        </label>
                                        <div class="resturant-type-group px-0">
                                            <label class="form-check form--check mr-2 mr-md-4">
                                                <input class="form-check-input show_min_max" data-count="` + count + `" type="radio" value="multi"
                                                name="options[` + count + `][type]" id="type` + count +
                    `" checked
                                                >
                                                <span class="form-check-label">
                                                    {{ translate('Multiple Selection') }}
                    </span>
                </label>

                <label class="form-check form--check mr-2 mr-md-4">
                    <input class="form-check-input hide_min_max" data-count="` + count + `" type="radio" value="single"
                    name="options[` + count + `][type]" id="type` + count +
                    `"
                                                >
                                                <span class="form-check-label">
                                                    {{ translate('Single Selection') }}
                    </span>
                </label>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-6">
        <div class="row g-2">
            <div class="col-6">
                <label for="">{{ translate('Min_Option_to_Select') }}</label>
                                            <input id="min_max1_` + count + `" required  name="options[` + count + `][min]" class="form-control" type="number" min="1">
                                        </div>
                                        <div class="col-6">
                                            <label for="">{{ translate('Max_Option_to_Select') }}</label>
                                            <input id="min_max2_` + count + `"   required name="options[` + count + `][max]" class="form-control" type="number" min="1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="option_price_` + count + `" >
                                <div class="bg-white border rounded p-3 pb-0 mt-3">
                                    <div  id="option_price_view_` + count + `">
                                        <div class="row g-3 add_new_view_row_class mb-3">
                                            <div class="col-md-3 col-sm-6">
                                                <label for="">{{ translate('Option_name') }} &nbsp;<span class="form-label-secondary text-danger"
                                data-toggle="tooltip" data-placement="right"
                                data-original-title="{{ translate('messages.Required.') }}"> *
                                </span></label>
                                                <input class="form-control" required type="text" name="options[` +
                    count +
                    `][values][0][label]" id="">
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <label for="">{{ translate('Additional_price') }} ({{ \App\CentralLogics\Helpers::currency_symbol() }})&nbsp;<span class="form-label-secondary text-danger"
                                data-toggle="tooltip" data-placement="right"
                                data-original-title="{{ translate('messages.Required.') }}"> *
                                </span></label>
                                                <input class="form-control" required type="number" min="0" step="0.01" name="options[` +
                    count +
                    `][values][0][optionPrice]" id="">
                                            </div>
                                            <div class="col-md-3 col-sm-6 hide_this">
                                                <label for="">{{ translate('Stock') }}</label>
                                                <input class="form-control stock_disable count_stock" required type="number" min="0" max="9999999" name="options[` +
                    count + `][values][0][total_stock]" id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3 p-3 mr-1 d-flex "  id="add_new_button_` + count +
                    `">
                                        <button type="button" class="btn btn--primary btn-outline-primary add_new_row_button" data-count="` +
                    count + `">{{ translate('Add_New_Option') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;

                $("#add_new_option").append(add_option_view);
                // Initialize autocomplete for the newly added input
                updatestockCount();
                // let selector = 'input[name="options[' + count + '][name]"]' ;
                let selector = '.new_option_name' ;
                alert(selector); //options[2][name]
                initializeAutocomplete(selector);


            });


        });




        // Function to initialize autocomplete
        function initializeAutocomplete(selector) {
            $('.new_option_name').autocomplete({
                source: function(request, cb) {
                    $.ajax({
                        url: "{{ route('admin.restaurant.get_addons_by_ajax') }}", // Provide your URL here
                        method: 'GET',
                        data: {
                            term: request.term // Send the user input as 'term'
                        },
                        dataType: 'json',
                        success: function(data) {
                           
                            let result = [{
                                'label': 'جاري البحث عن نتائج',
                                'value': ''
                            }];
                            console.log(data.length);
                            // if (data.length) {
                                
                                result = $.map(data, function(item) {
                                    return {
                                        label: item.name,
                                        value: item.name,
                                        data: item
                                    };
                                });
                                console.log(result.val);
                            // }
                            // cb(result);
                        },
                        error: function() {
                            cb([]);
                        }
                    });
                },
                select: function(event, ui) {
                    if (ui.item.data) {
                        // Handle the selection event if necessary
                    }
                }
            });
        }

        function add_new_row_button(data) {
            count = data;
            countRow = 1 + $('#option_price_view_' + data).children('.add_new_view_row_class').length;
            let add_new_row_view = `
            <div class="row add_new_view_row_class mb-3 position-relative pt-3 pt-sm-0">
                <div class="col-md-3 col-sm-5">
                        <label for="">{{ translate('Option_name') }} &nbsp;<span class="form-label-secondary text-danger"
                                data-toggle="tooltip" data-placement="right"
                                data-original-title="{{ translate('messages.Required.') }}"> *
                                </span></label>
                        <input class="form-control" required type="text" name="options[` + count + `][values][` +
                countRow + `][label]" id="">
                    </div>
                    <div class="col-md-3 col-sm-5">
                        <label for="">{{ translate('Additional_price') }} ({{ \App\CentralLogics\Helpers::currency_symbol() }})&nbsp;<span class="form-label-secondary text-danger"
                                data-toggle="tooltip" data-placement="right"
                                data-original-title="{{ translate('messages.Required.') }}"> *
                                </span></label>
                        <input class="form-control"  required type="number" min="0" step="0.01" name="options[` +
                count + `][values][` + countRow +
                `][optionPrice]" id="">
                    </div>


                    <div class="col-md-3 col-sm-6 hide_this">
                                                <label for="">{{ translate('Stock') }}</label>
                                                <input class="form-control stock_disable count_stock" required type="number" min="0" max="9999999" name="options[` +
                count + `][values][` + countRow + `][total_stock]" id="">
                                            </div>


                    <div class="col-sm-2 max-sm-absolute">
                        <label class="d-none d-sm-block">&nbsp;</label>
                        <div class="mt-1">
                            <button type="button" class="btn btn-danger btn-sm deleteRow"
                                title="{{ translate('Delete') }}">
                                <i class="tio-add-to-trash"></i>
                            </button>
                        </div>
                </div>
            </div>`;
            $('#option_price_view_' + data).append(add_new_row_view);
            updatestockCount();

        }

        $('#restaurant_id').on('change', function() {
            let route = '{{ url('/') }}/admin/restaurant/get-addons?data[]=0&restaurant_id=';
            let restaurant_id = $(this).val();
            let id = 'add_on';
            getRestaurantData(route, restaurant_id, id);

        });

        function getRestaurantData(route, restaurant_id, id) {
            $.get({
                url: route + restaurant_id,
                dataType: 'json',
                success: function(data) {
                    $('#' + id).empty().append(data.options);
                },
            });
        }

        $('.get-request').on('change', function() {
            let route = '{{ url('/') }}/admin/food/get-categories?parent_id=' + $(this).val();
            let id = 'sub-categories';
            getRequest(route, id);
        });

        function getRequest(route, id) {
            $.get({
                url: route,
                dataType: 'json',
                success: function(data) {
                    $('#' + id).empty().append(data.options);
                },
            });
        }

        $(document).on('ready', function() {
            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function() {
                let select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });
        $('.js-data-example-ajax').select2({
            ajax: {
                url: '{{ url('/') }}/admin/restaurant/get-restaurants',
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                __port: function(params, success, failure) {
                    let $request = $.ajax(params);

                    $request.then(success);
                    $request.fail(failure);

                    return $request;
                }
            }
        });

        $('#food_form').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '{{ route('admin.food.store') }}',
                data: $('#food_form').serialize(),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(data) {
                    $('#loading').hide();
                    if (data.errors) {
                        for (let i = 0; i < data.errors.length; i++) {
                            toastr.error(data.errors[i].message, {
                                CloseButton: true,
                                ProgressBar: true
                            });
                        }
                    } else {
                        toastr.success(
                            '{{ translate('messages.product_added_successfully') }}', {
                                CloseButton: true,
                                ProgressBar: true
                            });
                        console.log(data);
                        setTimeout(function() {

                            // restaurant_id = "{{ $restaurant->id }}" ;
                            location.href = data.url;
                        }, 2000);
                    }
                }
            });
        });

        $('#reset_btn').click(function() {
            $('#restaurant_id').val(null).trigger('change');
            $('#category_id').val(null).trigger('change');
            $('#categories').val(null).trigger('change');
            $('#sub-veg').val(0).trigger('change');
            $('#add_on').val(null).trigger('change');
            $('#viewer').attr('src', "{{ dynamicAsset('public/assets/admin/img/upload.png') }}");
            $('#stock_type').val('unlimited').trigger('change');
            updatestockCount();
        });

        $('.add_new').on('click', function() {
            let categoryId = $(this).attr('data-categoryId');
            $('input[name=category_id]').val(categoryId);
        });
    </script>


    <script>
        $(document).on('click', '.sts-fld', function(e) {
            //e.preventDefault();
            const id = $(this).data('id');
            const url = $(this).data('url');

            const checkedValue = $(this).is(":checked");
            $.ajax({
                type: "GET",
                url: url,
                data: {
                    'id': id
                },
                success: function(data) {
                    if (data.type === 'yes') {
                        $(this).prop("checked", checkedValue);
                    } else if (data.type === 'no') {
                        $(this).prop("checked", !checkedValue);
                    }
                    toastr.success('{{ translate('messages.food_status_updated') }}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });
        });
    </script>
@endpush
