@extends('layouts.admin.app')
@section('title', translate('messages.zone_settings'))

@section('content')

    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header pb-0">
            <div class="d-flex flex-wrap justify-content-between align-items-start">
                <div class="d-flex align-items-start __gap-12px">
                    <img src="{{ dynamicAsset('/public/assets/admin/img/zone.png') }}" alt="">
                    <div>
                        <h1 class="page-header-title text-capitalize">
                            {{ translate('messages.Business_Zone_settings') }} : {{ $zone->name }}
                        </h1>
                        <p>
                            {{ translate('messages.Set_zone-wise_delivery_fees_and_incentives') }}
                        </p>
                    </div>
                </div>
                <div class="text--primary-2 py-1 d-flex flex-wrap align-items-center" type="button" data-toggle="modal"
                    data-target="#how-it-works">
                    <strong class="mr-2">{{ translate('See_how_it_works') }}</strong>
                    <div>
                        <i class="tio-info-outined"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <form action="{{ route('admin.zone.zone_settings_update', $zone->id) }}" method="post"
            class="card p-0 border-0 shadow--card">
            @csrf
            <div class="card-header">
                <h5 class="card-title align-items-center">
                    <span class="card-header-icon mr-2">
                        <i class="tio-settings-outlined"></i>
                    </span>
                    <span>{{ translate('Delivery_Charges_Settings') }}</span> &nbsp;
                    <img src="{{ dynamicAsset('/public/assets/admin/img/info-circle.svg') }}" data-toggle="tooltip"
                        title="{{ translate('messages.Set_zone_wise_delivery_charges_for_this_business_zone') }}"
                        alt="">
                </h5>
            </div>
            <div class="card-body zone-setup">
                <div class="row">
                    <div class="col-sm-6 col-lg-4">
                        <div class="form-group">
                            <label class="input-label text-capitalize d-inline-flex alig-items-center">
                                {{ translate('messages.minimum_delivery_charge') }}
                                ({{ \App\CentralLogics\Helpers::currency_symbol() }})&nbsp;
                                <span data-toggle="tooltip" data-placement="right"
                                    data-original-title="{{ translate('messages.Set_the_minimum_delivery_for_each_order_in_this_business_zone.') }}"
                                    class="input-label-secondary text-danger"><img
                                        src="{{ dynamicAsset('/public/assets/admin/img/info-circle.svg') }}"
                                        alt="{{ translate('messages.maximum_shipping_charge') }}"></span>
                            </label>
                            <input id="min_delivery_charge" name="minimum_delivery_charge" type="number" min=".001"
                                step=".001" class="form-control h--45px" required
                                placeholder="{{ translate('messages.Ex:_100') }}"
                                value="{{ $zone->minimum_shipping_charge }}">
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="form-group">
                            <label class="input-label text-capitalize d-inline-flex alig-items-center">
                                {{ translate('messages.maximum_delivery_charge') }}
                                ({{ \App\CentralLogics\Helpers::currency_symbol() }})&nbsp;
                                <span data-toggle="tooltip" data-placement="right"
                                    data-original-title="{{ translate('messages.Set_the_maximum_limit_for_the_total_delivery_charge._If_the_delivery_charge_crosses_the_limit,_it_will_not_add_any_extra_charge._Leave_it_empty_if_you_don’t_want_to_limit_the_delivery_charge.') }}"
                                    class="input-label-secondary text-danger"><img
                                        src="{{ dynamicAsset('/public/assets/admin/img/info-circle.svg') }}"
                                        alt="{{ translate('messages.maximum_shipping_charge') }}"></span>
                            </label>
                            <input id="maximum_shipping_charge" name="maximum_shipping_charge" type="number"
                                class="form-control h--45px" placeholder="{{ translate('messages.Ex:_10000') }} "
                                min="0" step=".001" value="{{ $zone->maximum_shipping_charge ?? '' }}">
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="form-group">
                            <label class="input-label text-capitalize d-inline-flex alig-items-center">
                                {{ translate('messages.delivery_charge_per_km') }}
                                ({{ \App\CentralLogics\Helpers::currency_symbol() }})&nbsp;
                                <span data-toggle="tooltip" data-placement="right"
                                    data-original-title="{{ translate('messages.Set_a_delivery_charge_for_each_kilometer_for_this_business_zone.') }}"
                                    class="input-label-secondary "><img
                                        src="{{ dynamicAsset('/public/assets/admin/img/info-circle.svg') }}"
                                        alt="{{ translate('messages.maximum_shipping_charge') }}"></span>
                            </label>
                            <input id="delivery_charge_per_km" name="per_km_delivery_charge" type="number" min=".001"
                                step=".001" class="form-control h--45px" required
                                placeholder="{{ translate('messages.Ex:_100') }}"
                                value="{{ $zone->per_km_shipping_charge }}">
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="form-group">
                            <label class="input-label text-capitalize d-inline-flex alig-items-center">
                                {{ translate('messages.maximum_COD_order_amount') }}
                                ({{ \App\CentralLogics\Helpers::currency_symbol() }})&nbsp;
                                <span data-toggle="tooltip" data-placement="right"
                                    data-original-title="{{ translate('messages.Add_the_maximum_Cash_On_Delivery_order_limit_for_this_business_zone._Leave_it_empty_if_you_don’t_want_to_limit_the_COD_order_amount') }}"
                                    class="input-label-secondary"><img
                                        src="{{ dynamicAsset('/public/assets/admin/img/info-circle.svg') }}"
                                        alt="{{ translate('messages.max_cod_order_amount_status') }}"></span>
                            </label>
                            <input id="max_cod_order_amount" name="max_cod_order_amount" min="0" step=".001"
                                type="number" class="form-control h--45px"
                                placeholder="{{ translate('messages.Ex:_10000') }} "
                                value="{{ $zone->max_cod_order_amount ?? '' }}">
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="form-group">
                            <div class="d-flex justify-content-between align-items-center">
                                <label class="input-label text-capitalize d-inline-flex alig-items-center"
                                    for="increased_delivery_fee">
                                    <span class="line--limit-1">{{ translate('messages.increase_delivery_charge') }} (%)
                                        <span data-toggle="tooltip" data-placement="right"
                                            data-original-title="{{ translate('messages.Set_an_additional_delivery_charge_in_percentage_for_any_emergency_situations._This_amount_will_be_added_to_the_delivery_charge.') }}"
                                            class="input-label-secondary"><img
                                                src="{{ dynamicAsset('/public/assets/admin/img/info-circle.svg') }}"
                                                alt="{{ translate('messages.dm_maximum_order_hint') }}"></span>
                                </label>
                                <label class="toggle-switch toggle-switch-sm">
                                    <input type="checkbox" class="toggle-switch-input"
                                        name="increased_delivery_fee_status" id="increased_delivery_fee_status"
                                        value="1" {{ $zone->increased_delivery_fee_status == 1 ? 'checked' : '' }}>
                                    <span class="toggle-switch-label">
                                        <div class="toggle-switch-indicator"></div>
                                    </span>
                                </label>
                            </div>
                            <input type="number" name="increased_delivery_fee" class="form-control"
                                id="increased_delivery_fee"
                                value="{{ $zone->increased_delivery_fee ? $zone->increased_delivery_fee : '' }}"
                                min="0" step=".001" placeholder="{{ translate('messages.Ex:_100') }}"
                                {{ $zone->increased_delivery_fee_status == 1 ? ' ' : 'readonly' }}>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="form-group">
                            <div class="d-flex justify-content-between align-items-center">
                                <label class="input-label text-capitalize d-inline-flex alig-items-center"
                                    for="increased_delivery_fee">
                                    <span
                                        class="line--limit-1">{{ translate('messages.increase_delivery_charge_message') }}
                                        <span data-toggle="tooltip" data-placement="right"
                                            data-original-title="{{ translate('messages.Customers_will_see_the_delivery_charge_increased_reason_on_the_website_and_customer_app.') }}"
                                            class="input-label-secondary"><img
                                                src="{{ dynamicAsset('/public/assets/admin/img/info-circle.svg') }}"
                                                alt="{{ translate('messages.dm_maximum_order_hint') }}"></span>

                                </label>
                            </div>
                            <input type="text" name="increase_delivery_charge_message" class="form-control"
                                id="increase_delivery_charge_message"
                                value="{{ $zone->increase_delivery_charge_message ? $zone->increase_delivery_charge_message : '' }}"
                                placeholder="{{ translate('messages.Ex:_Rainy_season') }} "
                                {{ $zone->increased_delivery_fee_status == 1 ? ' ' : 'readonly' }}>
                        </div>
                    </div>

                </div>
                <div class="btn--container mt-3 justify-content-end">
                    <button id="reset_btn" type="reset"
                        class="btn btn--reset">{{ translate('messages.reset') }}</button>
                    <button type="submit" class="btn btn--primary">{{ translate('messages.save') }}</button>
                </div>
            </div>
        </form>
        <div class="mt-4 pb-2 text-center">
            <h3>{{ translate('messages.Incentive_Settings_for_Deliveryman') }}</h3>
            <p>
                {{ translate('messages.Motivate_deliverymen_to_achieve_daily_earning_targets_and_provide_additional_incentives_to_encourage_increased_deliveries.') }}
            </p>
        </div>
        <div class="card shadow--card border-0 mt-3 p-0">
            <div class="card-header flex-wrap __gap-5px">
                <h5 class="card-title align-items-center">
                    <span class="card-header-icon mr-2">
                        <i class="tio-settings-outlined"></i>
                    </span>
                    <span>{{ translate('Incentive_Settings') }}</span> &nbsp;
                    <img src="{{ dynamicAsset('/public/assets/admin/img/info-circle.svg') }}" data-toggle="tooltip"
                        title="{{ translate('messages.Set_the_daily_earning_target_and_the_incentive_upon_completing_the_target.') }}"
                        alt="">
                </h5>
            </div>

            <div class="card-body">
                <!-- Incentive Item -->
                <div class="__bg-F8F9FC-card">
                    @forelse ($zone->incentives as $key => $incentive)
                        <div class="d-flex align-items-end __gap-15px mb-2">
                            <div class="row g-3 w-0 flex-grow-1">
                                <div class="col-sm-6">
                                    @if ($key == 0)
                                        <label class="form-label">{{ translate('Daily_Earning_Target') }}
                                            {{ \App\CentralLogics\Helpers::currency_symbol() }}


                                            <span data-toggle="tooltip" data-placement="right"
                                                data-original-title="{{ translate('messages.Set_the_daily_earning_target_for_deliverymen_for_this_business_zone.') }}"
                                                class="input-label-secondary text-danger"><img
                                                    src="{{ dynamicAsset('/public/assets/admin/img/info-circle.svg') }}"
                                                    alt="{{ translate('messages.maximum_shipping_charge') }}"></span>

                                        </label>
                                    @endif
                                    <input type="number" readonly
                                        value="{{ \App\CentralLogics\Helpers::format_currency($incentive->earning) }}"
                                        placeholder="{{ \App\CentralLogics\Helpers::format_currency($incentive->earning) }}"
                                        class="form-control">
                                </div>
                                <div class="col-sm-6">
                                    @if ($key == 0)
                                        <label class="form-label">{{ translate('Incentive_for_Completing_Target') }}
                                            {{ \App\CentralLogics\Helpers::currency_symbol() }}

                                            <span data-toggle="tooltip" data-placement="right"
                                                data-original-title="{{ translate('messages.Set_the_incentive_amount_for_deliverymen_on_completing_the_daily_earning_target_for_this_business_zone.') }}"
                                                class="input-label-secondary text-danger"><img
                                                    src="{{ dynamicAsset('/public/assets/admin/img/info-circle.svg') }}"
                                                    alt="{{ translate('messages.maximum_shipping_charge') }}"></span>
                                        </label>
                                    @endif
                                    <input readonly type="number"
                                        value="{{ \App\CentralLogics\Helpers::format_currency($incentive->incentive) }}"
                                        placeholder="{{ \App\CentralLogics\Helpers::format_currency($incentive->incentive) }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="mb-1">
                                <a class="btn action-btn btn--danger btn-outline-danger form-alert" href="javascript:"
                                    data-id="attribute-{{ $incentive->id }}"
                                    data-message="{{ translate('messages.want_to_delece_this_incentive') }}"
                                    title="{{ translate('messages.delete') }}"><i class="tio-delete-outlined"></i></a>
                            </div>
                            <form action="{{ route('admin.zone.incentive.destory', ['id' => $incentive->id]) }}"
                                method="post" id="attribute-{{ $incentive->id }}">
                                @csrf @method('delete')
                            </form>
                        </div>
                    @empty
                    @endforelse
                    <div class="text-right mt-3">
                        <button type="button" id="show_incentive_button"
                            class="btn text--primary py-1 ml-auto show-incentive">{{ translate('Add_New_Incentive_+') }}</button>
                    </div>
                    <div class="d-none" id="show_incentive">
                        <!-- Incentive Item -->
                        <form action="{{ route('admin.zone.incentive.store', ['zone_id' => $zone->id]) }}"
                            method="POST">
                            @csrf
                            <div class="d-flex div_size align-items-end __gap-16px mb-2">
                                <div class="row g-3 w-0 flex-grow-1">
                                    <div class="col-sm-6">
                                        @if (count($zone->incentives) == 0)
                                            <label class="form-label">{{ translate('Daily_Earning_Target') }}
                                                {{ \App\CentralLogics\Helpers::currency_symbol() }}</label>
                                        @endif
                                        <input type="number" name="earning" step=".01" min="1"
                                            max="99999999999.999" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6">
                                        @if (count($zone->incentives) == 0)
                                            <label class="form-label">{{ translate('Incentive_for_Completing_Target') }}
                                                {{ \App\CentralLogics\Helpers::currency_symbol() }} </label>
                                        @endif
                                        <input type="number" name="incentive" id="" min="1"
                                            max="99999999999.999" class="form-control" step=".01"
                                            placeholder="{{ translate('messages.enter_incentive') }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="btn--container mt-3 justify-content-end">
                                <button id="reset_btn" type="reset"
                                    class="btn btn--reset hide-incentive">{{ translate('messages.reset') }}</button>
                                <button type="submit" class="btn btn--primary">{{ translate('messages.save') }}</button>
                            </div>
                        </form>
                    </div>


                </div>

            </div>
        </div>



        <!---GENERAL SETTINGS --->
        <h4 class="card-title my-4 mb-3 pt-2">
            <span class="card-header-icon mr-2">
                <i class="tio-settings-outlined"></i>
            </span>
            <span>{{ translate('messages.business_Rule_setting') }}</span>
        </h4>

        <div class="card">
            <div class="card-body">

                <div class="row">



                    <div class="col-sm-6 col-lg-4 my-1">
                        @php($odc = \App\Models\BusinessSetting::where('key', 'order_delivery_verification')->first())
                        @php($odc = $odc ? $odc->value : 0)
                        <div class="form-group mb-0">

                            <label
                                class="toggle-switch h--45px toggle-switch-sm d-flex justify-content-between border rounded px-3 py-0 form-control">
                                <span class="pr-1 d-flex align-items-center switch--label">
                                    <span class="line--limit-1">
                                        {{ translate('messages.order_delivery_verification') }}
                                    </span>
                                    <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="{{ translate('When_a_deliveryman_arrives_for_delivery,_Customers_will_get_a_verification_code_on_the_order_details_section_in_the_Customer_App_and_needs_to_provide_the_code_to_the_delivery_man_to_verify_the_order_delivery') }}"><img
                                            src="{{ dynamicAsset('/public/assets/admin/img/info-circle.svg') }}"
                                            alt="{{ translate('messages.order_varification_toggle') }}">
                                    </span>
                                </span>
                                <input type="checkbox" data-id="odc1" data-type="toggle"
                                    data-image-on="{{ dynamicAsset('/public/assets/admin/img/modal/order-delivery-verification-on.png') }}"
                                    data-image-off="{{ dynamicAsset('/public/assets/admin/img/modal/order-delivery-verification-off.png') }}"
                                    data-title-on="{{ translate('Want_to_enable') }} <strong>{{ translate('Delivery_Verification') }}</strong> ?"
                                    data-title-off="{{ translate('Want_to_disable') }} <strong>{{ translate('Delivery_Verification') }}</strong> ?"
                                    data-text-on="<p>{{ translate('If_enabled,_the_Deliveryman_has_to_verify_the_order_during_delivery_through_a_4-digit_verification_code') }}</p>"
                                    data-text-off="<p>{{ translate('If_disabled,_Deliveryman_will_deliver_the_food_and_update_the_status_without_using_any_verification_code') }}</p>"
                                    class="toggle-switch-input dynamic-checkbox-toggle" value="1" name="odc"
                                    id="odc1" {{ $odc == 1 ? 'checked' : '' }}>
                                <span class="toggle-switch-label text">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 my-1">
                        <div class="form-group mb-0">
                            @php($home_delivery = \App\Models\BusinessSetting::where('key', 'home_delivery')->first())
                            @php($home_delivery = $home_delivery ? $home_delivery?->value : 0)
                            <label
                                class="toggle-switch h--45px toggle-switch-sm d-flex justify-content-between border rounded px-3 py-0 form-control">
                                <span class="pr-1 d-flex align-items-center switch--label">
                                    <span class="line--limit-1">
                                        {{ translate('Home Delivery') }}
                                    </span>
                                    <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="{{ translate('If_enabled,_customers_can_choose_Home_Delivery_option_from_the_customer_app_and_website') }}"><img
                                            src="{{ dynamicAsset('/public/assets/admin/img/info-circle.svg') }}"
                                            alt="{{ translate('Home Delivery') }}"></span>
                                </span>
                                <input type="checkbox" data-id="home_delivery" data-type="toggle"
                                    data-image-on="{{ dynamicAsset('/public/assets/admin/img/modal/home-delivery-on.png') }}"
                                    data-image-off="{{ dynamicAsset('/public/assets/admin/img/modal/home-delivery-off.png') }}"
                                    data-title-on="{{ translate('want_to_enable') }} <strong>{{ translate('home_delivery') }}?</strong>"
                                    data-title-off="{{ translate('want_to_disable') }} <strong>{{ translate('home_delivery') }}</strong>?"
                                    data-text-on="<p>{{ translate('if_enabled,customers_can_use_home_delivery_option_during_checkout_from_the_customer_app_or_website') }}</p>"
                                    data-text-off="<p>{{ translate('if_disabled,the_home_delivery_feature_will_be_hidden_from_the_customer_app_and_website') }}</p>"
                                    class="toggle-switch-input dynamic-checkbox-toggle" name ="home_delivery"
                                    id="home_delivery" class="toggle-switch-input" value="1"
                                    {{ $home_delivery == 1 ? 'checked' : '' }}>
                                <span class="toggle-switch-label text">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 my-1">
                        <div class="form-group mb-0">
                            @php($take_away = \App\Models\BusinessSetting::where('key', 'take_away')->first())
                            @php($take_away = $take_away ? $take_away?->value : 0)
                            <label
                                class="toggle-switch h--45px toggle-switch-sm d-flex justify-content-between border rounded px-3 py-0 form-control">
                                <span class="pr-1 d-flex align-items-center switch--label">
                                    <span class="line--limit-1">
                                        {{ translate('Takeaway') }}
                                    </span>
                                    <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="{{ translate('If_enabled,_customers_can_use_the_Takeaway_feature_during_checkout_from_the_Customer_App_or_Website') }}"><img
                                            src="{{ dynamicAsset('/public/assets/admin/img/info-circle.svg') }}"
                                            alt="{{ translate('Home Delivery') }}"></span>
                                </span>
                                <input type="checkbox" name="take_away" data-id="take_away" data-type="toggle"
                                    data-image-on="{{ dynamicAsset('/public/assets/admin/img/modal/takeaway-on.png') }}"
                                    data-image-off="{{ dynamicAsset('/public/assets/admin/img/modal/takeaway-off.png') }}"
                                    data-title-on="{{ translate('want_to_enable') }} <strong>{{ translate('takeaway') }}</strong> {{ translate('feature') }}?"
                                    data-title-off="{{ translate('want_to_disable') }} <strong>{{ translate('takeaway') }}</strong> {{ translate('feature') }}?"
                                    data-text-on="<p>{{ translate('if_enabled,customers_can_use_the_takeaway_feature_during_checkout_from_the_customer_app_or_website') }}</p>"
                                    data-text-off="<p>{{ translate('if_disabled,the_takeaway_feature_will_be_hidden_from_the_customer_app_or_website') }}</p>"
                                    class="toggle-switch-input dynamic-checkbox-toggle" id="take_away"
                                    {{ $take_away == 1 ? 'checked' : '' }} value="1">
                                <span class="toggle-switch-label text">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 my-1">
                        <div class="form-group mb-0">
                            @php($repeat_order_option = \App\Models\BusinessSetting::where('key', 'repeat_order_option')->first())
                            @php($repeat_order_option = $repeat_order_option ? $repeat_order_option?->value : 0)
                            <label
                                class="toggle-switch h--45px toggle-switch-sm d-flex justify-content-between border rounded px-3 py-0 form-control"
                                data-toggle="modal" data-target="#repeat-order">
                                <span class="pr-1 d-flex align-items-center switch--label">
                                    <span class="line--limit-1">
                                        {{ translate('messages.repeat_order_option') }}
                                    </span>
                                    <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="{{ translate('If_enabled,_customers_can_re-order_foods_from_their_previous_orders.') }}"><img
                                            src="{{ dynamicAsset('/public/assets/admin/img/info-circle.svg') }}"
                                            alt="{{ translate('messages.repeat_order_option') }}"> </span>
                                </span>
                                <input type="checkbox" id="repeat_order_option" name="repeat_order_option"
                                    value="1" data-id="repeat_order_option" data-type="toggle"
                                    data-image-on="{{ dynamicAsset('/public/assets/admin/img/modal/home-delivery-on.png') }}"
                                    data-image-off="{{ dynamicAsset('/public/assets/admin/img/modal/home-delivery-off.png') }}"
                                    data-title-on="{{ translate('want_to_enable') }} <strong>{{ translate('repeat_order') }}</strong> {{ translate('feature') }}?"
                                    data-title-off="{{ translate('want_to_disable') }} <strong>{{ translate('repeat_order') }}</strong> {{ translate('feature') }}?"
                                    data-text-on="<p>{{ translate('if_enabled,customers_can_order_again_from_their_previous_order_history') }}</p>"
                                    data-text-off="<p>{{ translate('if_disabled,customers_won’t_find_any_re-order_button_in_the_order_history') }}</p>"
                                    class="toggle-switch-input dynamic-checkbox-toggle"
                                    {{ $repeat_order_option == 1 ? 'checked' : '' }}>
                                <span class="toggle-switch-label text">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 my-1">
                        <div class="form-group mb-0">
                            @php($order_subscription = \App\Models\BusinessSetting::where('key', 'order_subscription')->first())
                            @php($order_subscription = $order_subscription ? $order_subscription?->value : 0)
                            <label
                                class="toggle-switch h--45px toggle-switch-sm d-flex justify-content-between border rounded px-3 py-0 form-control"
                                data-toggle="modal" data-target="#repeat-order">
                                <span class="pr-1 d-flex align-items-center switch--label">
                                    <span class="line--limit-1">
                                        {{ translate('messages.subscription_order') }}
                                    </span>
                                    <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="{{ translate('If_enabled,_costumes_can_place_orders_on_a_subscription-based.') }}"><img
                                            src="{{ dynamicAsset('/public/assets/admin/img/info-circle.svg') }}"
                                            alt="{{ translate('messages.subscription_order') }}"> </span>
                                </span>
                                <input type="checkbox" id="subscription_order" name="order_subscription" value="1"
                                    data-id="subscription_order" data-type="toggle"
                                    data-image-on="{{ dynamicAsset('/public/assets/admin/img/modal/home-delivery-on.png') }}"
                                    data-image-off="{{ dynamicAsset('/public/assets/admin/img/modal/home-delivery-off.png') }}"
                                    data-title-on="{{ translate('want_to_enable') }} <strong>{{ translate('subscription') }}</strong> {{ translate('feature') }}?"
                                    data-title-off="{{ translate('want_to_disable') }} <strong>{{ translate('subscription') }}</strong> {{ translate('feature') }}?"
                                    data-text-on="<p>{{ translate('if_enabled,customers_can_order_food_on_a_subscription_basis._customers_can_select_time_with_the_delivery_slot_from_the_calendar_to_their_preferences') }}</p>"
                                    data-text-off="<p>{{ translate('if_disabled,customers_won’t_be_able_to_order_food_on_a_subscription-based') }}</p>"
                                    class="toggle-switch-input dynamic-checkbox-toggle"
                                    {{ $order_subscription == 1 ? 'checked' : '' }}>
                                <span class="toggle-switch-label text">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 my-1">
                        @php($schedule_order = \App\Models\BusinessSetting::where('key', 'schedule_order')->first())
                        @php($schedule_order = $schedule_order ? $schedule_order->value : 0)
                        <div class="form-group mb-0">
                            <label
                                class="toggle-switch h--45px toggle-switch-sm d-flex justify-content-between border rounded px-3 py-0 form-control">
                                <span class="pr-1 d-flex align-items-center switch--label">
                                    <span class="line--limit-1">
                                        {{ translate('messages.scheduled_Delivery') }}
                                    </span>
                                    <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="{{ translate('With_this_feature,_customers_can_choose_their_preferred_delivery_time_and_calendar_selection.') }}"><img
                                            src="{{ dynamicAsset('/public/assets/admin/img/info-circle.svg') }}"
                                            alt="{{ translate('messages.customer_varification_toggle') }}">
                                    </span>
                                </span>
                                <input type="checkbox" data-id="schedule_order" data-type="toggle"
                                    data-image-on="{{ dynamicAsset('/public/assets/admin/img/modal/schedule-on.png') }}"
                                    data-image-off="{{ dynamicAsset('/public/assets/admin/img/modal/schedule-off.png') }}"
                                    data-title-on="{{ translate('want_to_enable') }} <strong>{{ translate('schedule_delivery') }}</strong>?"
                                    data-title-off="{{ translate('want_to_disable') }} <strong>{{ translate('schedule_delivery') }}</strong>?"
                                    data-text-on="<p>{{ translate('if_enabled,customers_can_choose_a_suitable_delivery_schedule_during_checkout') }}</p>"
                                    data-text-off="<p>{{ translate('if_disabled,the_scheduled_delivery_feature_will_be_hidden') }}</p>"
                                    class="toggle-switch-input dynamic-checkbox-toggle" value="1"
                                    name="schedule_order" id="schedule_order"
                                    {{ $schedule_order == 1 ? 'checked' : '' }}>
                                <span class="toggle-switch-label text">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </div>
                    </div>








                </div>
                <div class="btn--container justify-content-end">
                    <button type="reset" id="reset_btn"
                        class="btn btn--reset location-reload">{{ translate('messages.Reset') }} </button>
                    <button type="{{ env('APP_MODE') != 'demo' ? 'submit' : 'button' }}"
                        class="btn btn--primary mb-2 call-demo"><i
                            class="tio-save-outlined mr-2"></i>{{ translate('messages.save_info') }}</button>
                </div>
            </div>
        </div>

    </div>

    <!-- How it Works -->
    <div class="modal fade" id="how-it-works">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true" class="tio-clear"></span>
                    </button>
                </div>
                <div class="modal-body pb-5 pt-0">
                    <div class="single-item-slider owl-carousel">
                        <div class="item">
                            <div class="max-544 mx-auto mb-20 text-center">
                                <img src="{{ dynamicAsset('/public/assets/admin/img/modal/zone1.png') }}" alt=""
                                    class="mb-20">
                                <h5 class="modal-title">{{ translate('messages.Zone_wise_delivery_charge_settings') }}
                                </h5>
                                <p>
                                    {{ translate('messages.You_can_set_a_different_delivery_charge,_order_limit_for_COD,_increase_delivery_charge_percentage,_etc.,_for_this_business_zone.') }}
                                </p>
                                <p>
                                    {{ translate('messages.Note:_Leave_this_section_empty_if_you_want_to_keep_the_default_charges_for_this_zone.') }}
                                </p>
                            </div>
                        </div>
                        <div class="item">
                            <div class="max-544 mx-auto mb-20 text-center">
                                <img src="{{ dynamicAsset('/public/assets/admin/img/modal/zone1.png') }}" alt=""
                                    class="mb-20">
                                <h5 class="modal-title">{{ translate('messages.Zone_wise_Incentives_for_Deliverymen') }}
                                </h5>
                                <p>
                                    {{ translate('messages.You_can_provide_a_certain_amount_of_incentives_to_deliverymen_of_this_zone_only.') }}
                                </p>
                                <p>
                                    {{ translate('messages.Note:_You_will_receive_an_instant_request_to_pay_the_incentive_amount_whenever_a_deliveryman_completes_his_target._To_see_the_incentive_requests_click_on_the_View_Incentive_Requests_button_below.') }}
                                </p>
                                <a href="{{ route('admin.delivery-man.incentive') }}" type="button"
                                    class="btn btn--primary">{{ translate('View_Incentive_Requests') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="slide-counter"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script_2')
    <script>
        "use strict";
        $('.show-incentive').click(function() {
            $('#show_incentive').removeClass('d-none');
            $('#show_incentive_button').addClass('d-none');
        })
        $('.hide-incentive').click(function() {
            $('#show_incentive').addClass('d-none');
            $('#show_incentive_button').removeClass('d-none');
        })

        $('#reset_btn').click(function() {
            location.reload(true);
        })
        $(document).on('ready', function() {
            $("#maximum_shipping_charge_status").on('change', function() {
                if ($("#maximum_shipping_charge_status").is(':checked')) {
                    $('#maximum_shipping_charge').removeAttr('readonly');
                } else {
                    $('#maximum_shipping_charge').attr('readonly', true);
                    $('#maximum_shipping_charge').val('Ex : 0');
                }
            });
            $("#max_cod_order_amount_status").on('change', function() {
                if ($("#max_cod_order_amount_status").is(':checked')) {
                    $('#max_cod_order_amount').removeAttr('readonly');
                } else {
                    $('#max_cod_order_amount').attr('readonly', true);
                    $('#max_cod_order_amount').val('Ex : 0');
                }
            });

            $("#increased_delivery_fee_status").on('change', function() {
                if ($("#increased_delivery_fee_status").is(':checked')) {
                    $('#increased_delivery_fee').removeAttr('readonly');
                    $('#increase_delivery_charge_message').removeAttr('readonly');
                } else {
                    $('#increased_delivery_fee').attr('readonly', true);
                    $('#increase_delivery_charge_message').attr('readonly', true);
                    $('#increased_delivery_fee').val('Ex : 0');
                    $('#increase_delivery_charge_message').val('');
                }
            });
        });
    </script>
@endpush
