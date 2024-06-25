<?php $__env->startSection('title', translate('Order_Settings')); ?>


<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex flex-wrap justify-content-between align-items-start">
                <h1 class="page-header-title mr-3">
                    <span class="page-header-icon">
                        <img src="<?php echo e(dynamicAsset('public/assets/admin/img/business.png')); ?>" class="w--20" alt="">
                    </span>
                    <span>
                        <?php echo e(translate('messages.business_setup')); ?>

                    </span>
                </h1>
                <div class="d-flex flex-wrap justify-content-end align-items-center flex-grow-1">
                    <div class="blinkings active">
                        <i class="tio-info-outined"></i>
                        <div class="business-notes">
                            <h6><img src="<?php echo e(dynamicAsset('/public/assets/admin/img/notes.png')); ?>" alt=""> <?php echo e(translate('Note')); ?></h6>
                            <div>
                                <?php echo e(translate('Don’t_forget_to_click_the_respective_‘Save_Information’_and_‘Submit’_buttons_below_to_save_changes')); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo $__env->make('admin-views.business-settings.partials.nav-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

            <form method="post" action="<?php echo e(route('admin.business-settings.update-order')); ?>">
                <?php echo csrf_field(); ?>
                <?php ($name = \App\Models\BusinessSetting::where('key', 'business_name')->first()); ?>
                <div class="row g-3">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="py-2">
                                    <div class="row g-3 align-items-end">
                                        <div class="col-sm-6 col-lg-4">
                                            <?php ($odc = \App\Models\BusinessSetting::where('key', 'order_delivery_verification')->first()); ?>
                                            <?php ($odc = $odc ? $odc->value : 0); ?>
                                            <div class="form-group mb-0">

                                                <label
                                                    class="toggle-switch h--45px toggle-switch-sm d-flex justify-content-between border rounded px-3 py-0 form-control">
                                                    <span class="pr-1 d-flex align-items-center switch--label">
                                                        <span class="line--limit-1">
                                                            <?php echo e(translate('messages.order_delivery_verification')); ?>

                                                        </span>
                                                        <span class="form-label-secondary text-danger d-flex"
                                                            data-toggle="tooltip" data-placement="right"
                                                            data-original-title="<?php echo e(translate('When_a_deliveryman_arrives_for_delivery,_Customers_will_get_a_verification_code_on_the_order_details_section_in_the_Customer_App_and_needs_to_provide_the_code_to_the_delivery_man_to_verify_the_order_delivery')); ?>"><img
                                                                src="<?php echo e(dynamicAsset('/public/assets/admin/img/info-circle.svg')); ?>"
                                                                alt="<?php echo e(translate('messages.order_varification_toggle')); ?>">
                                                        </span>
                                                    </span>
                                                    <input type="checkbox"
                                                        data-id="odc1"
                                                        data-type="toggle"
                                                        data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/order-delivery-verification-on.png')); ?>"
                                                        data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/order-delivery-verification-off.png')); ?>"
                                                        data-title-on="<?php echo e(translate('Want_to_enable')); ?> <strong><?php echo e(translate('Delivery_Verification')); ?></strong> ?"
                                                        data-title-off="<?php echo e(translate('Want_to_disable')); ?> <strong><?php echo e(translate('Delivery_Verification')); ?></strong> ?"
                                                        data-text-on="<p><?php echo e(translate('If_enabled,_the_Deliveryman_has_to_verify_the_order_during_delivery_through_a_4-digit_verification_code')); ?></p>"
                                                        data-text-off="<p><?php echo e(translate('If_disabled,_Deliveryman_will_deliver_the_food_and_update_the_status_without_using_any_verification_code')); ?></p>"
                                                        class="toggle-switch-input dynamic-checkbox-toggle"
                                                    value="1"
                                                        name="odc" id="odc1" <?php echo e($odc == 1 ? 'checked' : ''); ?>>
                                                    <span class="toggle-switch-label text">
                                                        <span class="toggle-switch-indicator"></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-4">
                                            <div class="form-group mb-0">
                                                <?php ($home_delivery = \App\Models\BusinessSetting::where('key', 'home_delivery')->first()); ?>
                                                <?php ($home_delivery = $home_delivery ? $home_delivery?->value : 0); ?>
                                                <label
                                                    class="toggle-switch h--45px toggle-switch-sm d-flex justify-content-between border rounded px-3 py-0 form-control">
                                                    <span class="pr-1 d-flex align-items-center switch--label">
                                                        <span class="line--limit-1">
                                                            <?php echo e(translate('Home Delivery')); ?>

                                                        </span>
                                                        <span class="form-label-secondary text-danger d-flex"
                                                            data-toggle="tooltip" data-placement="right"
                                                            data-original-title="<?php echo e(translate('If_enabled,_customers_can_choose_Home_Delivery_option_from_the_customer_app_and_website')); ?>"><img
                                                                src="<?php echo e(dynamicAsset('/public/assets/admin/img/info-circle.svg')); ?>"
                                                                alt="<?php echo e(translate('Home Delivery')); ?>"></span>
                                                    </span>
                                                    <input type="checkbox"

                                                    data-id="home_delivery"
                                                    data-type="toggle"
                                                    data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/home-delivery-on.png')); ?>"
                                                    data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/home-delivery-off.png')); ?>"
                                                    data-title-on="<?php echo e(translate('want_to_enable')); ?> <strong><?php echo e(translate('home_delivery')); ?>?</strong>"
                                                    data-title-off="<?php echo e(translate('want_to_disable')); ?> <strong><?php echo e(translate('home_delivery')); ?></strong>?"
                                                    data-text-on="<p><?php echo e(translate('if_enabled,customers_can_use_home_delivery_option_during_checkout_from_the_customer_app_or_website')); ?></p>"
                                                    data-text-off="<p><?php echo e(translate('if_disabled,the_home_delivery_feature_will_be_hidden_from_the_customer_app_and_website')); ?></p>"
                                                    class="toggle-switch-input dynamic-checkbox-toggle"



                                                    name ="home_delivery" id="home_delivery"
                                                    class="toggle-switch-input"


                                                    value="1" <?php echo e($home_delivery == 1 ? 'checked' : ''); ?>>
                                                    <span class="toggle-switch-label text">
                                                        <span class="toggle-switch-indicator"></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-4">
                                            <div class="form-group mb-0">
                                                <?php ($take_away = \App\Models\BusinessSetting::where('key', 'take_away')->first()); ?>
                                            <?php ($take_away = $take_away ? $take_away?->value : 0); ?>
                                                <label
                                                    class="toggle-switch h--45px toggle-switch-sm d-flex justify-content-between border rounded px-3 py-0 form-control">
                                                    <span class="pr-1 d-flex align-items-center switch--label">
                                                        <span class="line--limit-1">
                                                            <?php echo e(translate('Takeaway')); ?>

                                                        </span>
                                                        <span class="form-label-secondary text-danger d-flex"
                                                            data-toggle="tooltip" data-placement="right"
                                                            data-original-title="<?php echo e(translate('If_enabled,_customers_can_use_the_Takeaway_feature_during_checkout_from_the_Customer_App_or_Website')); ?>"><img
                                                                src="<?php echo e(dynamicAsset('/public/assets/admin/img/info-circle.svg')); ?>"
                                                                alt="<?php echo e(translate('Home Delivery')); ?>"></span>
                                                    </span>
                                                    <input type="checkbox" name="take_away"


                                                    data-id="take_away"
                                                    data-type="toggle"
                                                    data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/takeaway-on.png')); ?>"
                                                    data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/takeaway-off.png')); ?>"
                                                    data-title-on="<?php echo e(translate('want_to_enable')); ?> <strong><?php echo e(translate('takeaway')); ?></strong> <?php echo e(translate('feature')); ?>?"
                                                    data-title-off="<?php echo e(translate('want_to_disable')); ?> <strong><?php echo e(translate('takeaway')); ?></strong> <?php echo e(translate('feature')); ?>?"
                                                    data-text-on="<p><?php echo e(translate('if_enabled,customers_can_use_the_takeaway_feature_during_checkout_from_the_customer_app_or_website')); ?></p>"
                                                    data-text-off="<p><?php echo e(translate('if_disabled,the_takeaway_feature_will_be_hidden_from_the_customer_app_or_website')); ?></p>"
                                                    class="toggle-switch-input dynamic-checkbox-toggle"

                                                    id="take_away"   <?php echo e($take_away == 1 ? 'checked' : ''); ?> value="1">
                                                    <span class="toggle-switch-label text">
                                                        <span class="toggle-switch-indicator"></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-4">
                                            <div class="form-group mb-0">
                                                <?php ($repeat_order_option = \App\Models\BusinessSetting::where('key', 'repeat_order_option')->first()); ?>
                                                <?php ($repeat_order_option = $repeat_order_option ? $repeat_order_option?->value : 0); ?>
                                                <label
                                                    class="toggle-switch h--45px toggle-switch-sm d-flex justify-content-between border rounded px-3 py-0 form-control" data-toggle="modal" data-target="#repeat-order">
                                                    <span class="pr-1 d-flex align-items-center switch--label">
                                                        <span class="line--limit-1">
                                                            <?php echo e(translate('messages.repeat_order_option')); ?>

                                                        </span>
                                                        <span class="form-label-secondary text-danger d-flex"
                                                            data-toggle="tooltip" data-placement="right"
                                                            data-original-title="<?php echo e(translate('If_enabled,_customers_can_re-order_foods_from_their_previous_orders.')); ?>"><img
                                                                src="<?php echo e(dynamicAsset('/public/assets/admin/img/info-circle.svg')); ?>"
                                                                alt="<?php echo e(translate('messages.repeat_order_option')); ?>">  </span>
                                                    </span>
                                                    <input type="checkbox"  id="repeat_order_option"
                                                    name="repeat_order_option" value="1"

                                                    data-id="repeat_order_option"
                                                    data-type="toggle"
                                                    data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/home-delivery-on.png')); ?>"
                                                    data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/home-delivery-off.png')); ?>"
                                                    data-title-on="<?php echo e(translate('want_to_enable')); ?> <strong><?php echo e(translate('repeat_order')); ?></strong> <?php echo e(translate('feature')); ?>?"
                                                    data-title-off="<?php echo e(translate('want_to_disable')); ?> <strong><?php echo e(translate('repeat_order')); ?></strong> <?php echo e(translate('feature')); ?>?"
                                                    data-text-on="<p><?php echo e(translate('if_enabled,customers_can_order_again_from_their_previous_order_history')); ?></p>"
                                                    data-text-off="<p><?php echo e(translate('if_disabled,customers_won’t_find_any_re-order_button_in_the_order_history')); ?></p>"
                                                    class="toggle-switch-input dynamic-checkbox-toggle"

                                                    <?php echo e($repeat_order_option == 1 ? 'checked' : ''); ?>

                                                    >
                                                    <span class="toggle-switch-label text">
                                                        <span class="toggle-switch-indicator"></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-4">
                                            <div class="form-group mb-0">
                                                <?php ($order_subscription = \App\Models\BusinessSetting::where('key', 'order_subscription')->first()); ?>
                                                <?php ($order_subscription = $order_subscription ? $order_subscription?->value : 0); ?>
                                                <label
                                                    class="toggle-switch h--45px toggle-switch-sm d-flex justify-content-between border rounded px-3 py-0 form-control" data-toggle="modal" data-target="#repeat-order">
                                                    <span class="pr-1 d-flex align-items-center switch--label">
                                                        <span class="line--limit-1">
                                                            <?php echo e(translate('messages.subscription_order')); ?>

                                                        </span>
                                                        <span class="form-label-secondary text-danger d-flex"
                                                            data-toggle="tooltip" data-placement="right"
                                                            data-original-title="<?php echo e(translate('If_enabled,_costumes_can_place_orders_on_a_subscription-based.')); ?>"><img
                                                                src="<?php echo e(dynamicAsset('/public/assets/admin/img/info-circle.svg')); ?>"
                                                                alt="<?php echo e(translate('messages.subscription_order')); ?>">  </span>
                                                    </span>
                                                    <input type="checkbox" id="subscription_order"
                                                    name="order_subscription" value="1"
                                                    data-id="subscription_order"
                                            data-type="toggle"
                                            data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/home-delivery-on.png')); ?>"
                                            data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/home-delivery-off.png')); ?>"
                                            data-title-on="<?php echo e(translate('want_to_enable')); ?> <strong><?php echo e(translate('subscription')); ?></strong> <?php echo e(translate('feature')); ?>?"
                                            data-title-off="<?php echo e(translate('want_to_disable')); ?> <strong><?php echo e(translate('subscription')); ?></strong> <?php echo e(translate('feature')); ?>?"
                                            data-text-on="<p><?php echo e(translate('if_enabled,customers_can_order_food_on_a_subscription_basis._customers_can_select_time_with_the_delivery_slot_from_the_calendar_to_their_preferences')); ?></p>"
                                            data-text-off="<p><?php echo e(translate('if_disabled,customers_won’t_be_able_to_order_food_on_a_subscription-based')); ?></p>"
                                            class="toggle-switch-input dynamic-checkbox-toggle"

                                                    <?php echo e($order_subscription == 1 ? 'checked' : ''); ?>

                                                    >
                                                    <span class="toggle-switch-label text">
                                                        <span class="toggle-switch-indicator"></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-4">
                                            <?php ($schedule_order = \App\Models\BusinessSetting::where('key', 'schedule_order')->first()); ?>
                                            <?php ($schedule_order = $schedule_order ? $schedule_order->value : 0); ?>
                                            <div class="form-group mb-0">
                                                <label
                                                    class="toggle-switch h--45px toggle-switch-sm d-flex justify-content-between border rounded px-3 py-0 form-control">
                                                    <span class="pr-1 d-flex align-items-center switch--label">
                                                        <span class="line--limit-1">
                                                            <?php echo e(translate('messages.scheduled_Delivery')); ?>

                                                        </span>
                                                        <span class="form-label-secondary text-danger d-flex"
                                                            data-toggle="tooltip" data-placement="right"
                                                            data-original-title="<?php echo e(translate('With_this_feature,_customers_can_choose_their_preferred_delivery_time_and_calendar_selection.')); ?>"><img
                                                                src="<?php echo e(dynamicAsset('/public/assets/admin/img/info-circle.svg')); ?>"
                                                                alt="<?php echo e(translate('messages.customer_varification_toggle')); ?>">
                                                        </span>
                                                    </span>
                                                    <input type="checkbox"
                                                     data-id="schedule_order"
                                                     data-type="toggle"
                                                     data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/schedule-on.png')); ?>"
                                                     data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/schedule-off.png')); ?>"
                                                     data-title-on="<?php echo e(translate('want_to_enable')); ?> <strong><?php echo e(translate('schedule_delivery')); ?></strong>?"
                                                     data-title-off="<?php echo e(translate('want_to_disable')); ?> <strong><?php echo e(translate('schedule_delivery')); ?></strong>?"
                                                     data-text-on="<p><?php echo e(translate('if_enabled,customers_can_choose_a_suitable_delivery_schedule_during_checkout')); ?></p>"
                                                     data-text-off="<p><?php echo e(translate('if_disabled,the_scheduled_delivery_feature_will_be_hidden')); ?></p>"
                                                     class="toggle-switch-input dynamic-checkbox-toggle"


                                                     value="1"
                                                        name="schedule_order" id="schedule_order"
                                                        <?php echo e($schedule_order == 1 ? 'checked' : ''); ?>>
                                                    <span class="toggle-switch-label text">
                                                        <span class="toggle-switch-indicator"></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-lg-4">
                                            <?php ($canceled_by_restaurant = \App\Models\BusinessSetting::where('key', 'canceled_by_restaurant')->first()); ?>
                                            <?php ($canceled_by_restaurant = $canceled_by_restaurant ? $canceled_by_restaurant->value : 0); ?>
                                            <div class="form-group mb-0">
                                                <label class="input-label text-capitalize d-flex alig-items-center"><span class="line--limit-1"><?php echo e(translate('restaurant_can_cancel_order')); ?> </span><span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('If_yes,_restaurants_can_cancel_orders.')); ?>">
                                                    <i class="tio-info-outined"></i>
                                                    </span></label>
                                                <div class="resturant-type-group border">
                                                    <label class="form-check form--check mr-2 mr-md-4">
                                                        <input class="form-check-input" type="radio" value="1"
                                                        name="canceled_by_restaurant" id="canceled_by_restaurant"
                                                        <?php echo e($canceled_by_restaurant == 1 ? 'checked' : ''); ?>>
                                                        <span class="form-check-label">
                                                            <?php echo e(translate('yes')); ?>

                                                        </span>
                                                    </label>
                                                    <label class="form-check form--check mr-2 mr-md-4">
                                                        <input class="form-check-input" type="radio" value="0"
                                                        name="canceled_by_restaurant" id="canceled_by_restaurant2"
                                                        <?php echo e($canceled_by_restaurant == 0 ? 'checked' : ''); ?> >
                                                        <span class="form-check-label">
                                                            <?php echo e(translate('no')); ?>

                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-4">
                                            <?php ($canceled_by_deliveryman = \App\Models\BusinessSetting::where('key', 'canceled_by_deliveryman')->first()); ?>
                                            <?php ($canceled_by_deliveryman = $canceled_by_deliveryman ? $canceled_by_deliveryman->value : 0); ?>
                                            <div class="form-group mb-0">
                                                <label class="input-label text-capitalize d-flex alig-items-center"><span class="line--limit-1"><?php echo e(translate('Delivery Man can Cancel Order')); ?></span> <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('If_yes,_deliveryman_can_cancel_orders.')); ?>">
                                                    <i class="tio-info-outined"></i>
                                                    </span></label>
                                                <div class="resturant-type-group border">
                                                    <label class="form-check form--check mr-2 mr-md-4">
                                                        <input class="form-check-input" type="radio" value="1"
                                                        name="canceled_by_deliveryman" id="canceled_by_deliveryman"
                                                        <?php echo e($canceled_by_deliveryman == 1 ? 'checked' : ''); ?>>
                                                        <span class="form-check-label">
                                                            <?php echo e(translate('yes')); ?>

                                                        </span>
                                                    </label>
                                                    <label class="form-check form--check mr-2 mr-md-4">
                                                        <input class="form-check-input" type="radio" value="0"
                                                        name="canceled_by_deliveryman" id="canceled_by_deliveryman2"
                                                        <?php echo e($canceled_by_deliveryman == 0 ? 'checked' : ''); ?>>
                                                        <span class="form-check-label">
                                                            <?php echo e(translate('no')); ?>

                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-lg-4">
                                            <?php ($order_confirmation_model = \App\Models\BusinessSetting::where('key', 'order_confirmation_model')->first()); ?>
                                            <?php ($order_confirmation_model = $order_confirmation_model ? $order_confirmation_model?->value : 'deliveryman'); ?>
                                            <div class="form-group mb-0">
                                                <label class="input-label text-capitalize d-flex alig-items-center"><span class="line--limit-1"><?php echo e(translate('messages.order_confirmation_model')); ?></span> <span class="input-label-secondary text--title" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('The_chosen_confirmation_model_will_confirm_the_order_first._For_example,_if_the_deliveryman_confirmation_model_is_enabled,_deliverymen_will_receive_and_confirm_orders_before_restaurants._After_that,_restaurants_will_get_orders_and_process_them.')); ?>">
                                                    <i class="tio-info-outined"></i>
                                                    </span></label>
                                                <div class="resturant-type-group border">
                                                    <label class="form-check form--check mr-2 mr-md-4">
                                                        <input class="form-check-input" type="radio" value="restaurant"
                                                        name="order_confirmation_model" id="order_confirmation_model"
                                                        <?php echo e($order_confirmation_model == 'restaurant' ? 'checked' : ''); ?>>
                                                        <span class="form-check-label">
                                                            <?php echo e(translate('messages.restaurant')); ?>

                                                        </span>
                                                    </label>
                                                    <label class="form-check form--check mr-2 mr-md-4">
                                                        <input class="form-check-input" type="radio" value="deliveryman"
                                                        name="order_confirmation_model" id="order_confirmation_model2"
                                                        <?php echo e($order_confirmation_model == 'deliveryman' ? 'checked' : ''); ?>>
                                                        <span class="form-check-label">
                                                            <?php echo e(translate('messages.deliveryman')); ?>

                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-lg-4">
                                            <?php ($schedule_order_slot_duration = \App\Models\BusinessSetting::where('key', 'schedule_order_slot_duration')->first()); ?>
                                            <?php ($schedule_order_slot_duration_time_formate = \App\Models\BusinessSetting::where('key', 'schedule_order_slot_duration_time_formate')->first()); ?>
                                            <div class="form-group mb-0">
                                                <label class="input-label text-capitalize d-flex alig-items-center"
                                                    for="schedule_order_slot_duration">
                                                    <span class="pr-1 d-flex align-items-center switch--label">
                                                        <span class="line--limit-1">
                                                            <?php echo e(translate('Time_Interval_for_Scheduled_Delivery')); ?>

                                                        </span>
                                                        <span class="form-label-secondary text-danger"
                                                        data-toggle="tooltip" data-placement="right"
                                                        data-original-title="<?php echo e(translate('By_activating_this_feature,_customers_can_choose_their_suitable_delivery_slot_according_to_a_30-minute_or_1-hour_interval_set_by_the_Admin')); ?>"><img
                                                            src="<?php echo e(dynamicAsset('/public/assets/admin/img/info-circle.svg')); ?>"
                                                            alt="<?php echo e(translate('Time_Interval_for_Scheduled_Delivery')); ?>"></span>
                                                    </span>
                                                </label>
                                                <div class="d-flex">
                                                    <input type="number"  name="schedule_order_slot_duration" class="form-control mr-3"
                                                    id="schedule_order_slot_duration"
                                                    value="<?php echo e($schedule_order_slot_duration?->value ? $schedule_order_slot_duration_time_formate?->value == 'hour' ? $schedule_order_slot_duration?->value /60 : $schedule_order_slot_duration?->value: 0); ?>"
                                                    min="0" required>
                                                    <select  name="schedule_order_slot_duration_time_formate" class="custom-select form-control w-90px">
                                                        <option  value="min" <?php echo e($schedule_order_slot_duration_time_formate?->value == 'min'? 'selected' : ''); ?>><?php echo e(translate('Min')); ?></option>
                                                        <option  value="hour" <?php echo e($schedule_order_slot_duration_time_formate?->value == 'hour'? 'selected' : ''); ?>><?php echo e(translate('Hour')); ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>




                                        <div class="col-sm-6 col-lg-4">
                                            <?php ($instant_order = \App\Models\BusinessSetting::where('key', 'instant_order')->first()); ?>
                                            <?php ($instant_order = $instant_order ? $instant_order->value : 0); ?>
                                            <div class="form-group mb-0">
                                                <label
                                                    class="toggle-switch h--45px toggle-switch-sm d-flex justify-content-between border rounded px-3 py-0 form-control">
                                                    <span class="pr-1 d-flex align-items-center switch--label">
                                                        <span class="line--limit-1">
                                                            <?php echo e(translate('messages.Instant_Order')); ?>

                                                        </span>
                                                        <span class="form-label-secondary text-danger d-flex"
                                                                data-toggle="tooltip" data-placement="right"
                                                                data-original-title="<?php echo e(translate('With_this_feature,_customers_can_order_instantly.')); ?>"><img
                                                                src="<?php echo e(dynamicAsset('/public/assets/admin/img/info-circle.svg')); ?>"
                                                                alt="<?php echo e(translate('messages.customer_varification_toggle')); ?>">
                                                        </span>
                                                    </span>
                                                    <input type="checkbox"

                                                    data-id="instant_order"
                                                    data-type="toggle"
                                                    data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/veg-on.png')); ?>"
                                                    data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/veg-off.png')); ?>"
                                                    data-title-on="<?php echo e(translate('want_to_enable')); ?> <strong><?php echo e(translate('instant_order')); ?></strong>?"
                                                    data-title-off="<?php echo e(translate('want_to_disable')); ?> <strong><?php echo e(translate('instant_order')); ?></strong>?"
                                                    data-text-on="<p><?php echo e(translate('if_enabled,customers_can_order_instantly')); ?></p>"
                                                    data-text-off="<p><?php echo e(translate('if_disabled,customers_can_not_order_instantly')); ?></p>"
                                                    class="toggle-switch-input dynamic-checkbox-toggle"

                                                     value="1"
                                                            name="instant_order" id="instant_order"
                                                        <?php echo e($instant_order == 1 ? 'checked' : ''); ?>>
                                                    <span class="toggle-switch-label text">
                                                        <span class="toggle-switch-indicator"></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-lg-4">
                                            <?php ($customer_date_order_sratus = \App\Models\BusinessSetting::where('key', 'customer_date_order_sratus')->first()); ?>
                                            <?php ($customer_date_order_sratus = $customer_date_order_sratus ? $customer_date_order_sratus->value : 0); ?>
                                            <div class="form-group mb-0">
                                                <label
                                                    class="toggle-switch h--45px toggle-switch-sm d-flex justify-content-between border rounded px-3 py-0 form-control">
                                                    <span class="pr-1 d-flex align-items-center switch--label">
                                                        <span class="line--limit-1">
                                                            <?php echo e(translate('messages.customer_date_order')); ?>

                                                        </span>
                                                        <span class="form-label-secondary text-danger d-flex"
                                                                data-toggle="tooltip" data-placement="right"
                                                                data-original-title="<?php echo e(translate('With_this_feature,_customers_can_not_select_schedule_date_over_the_given_days.')); ?>"><img
                                                                src="<?php echo e(dynamicAsset('/public/assets/admin/img/info-circle.svg')); ?>"
                                                                alt="<?php echo e(translate('messages.customer_varification_toggle')); ?>">
                                                        </span>
                                                    </span>
                                                    <input type="checkbox"
                                                    data-id="customer_date_order_sratus"
                                                data-type="toggle"
                                                data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/schedule-on.png')); ?>"
                                                data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/schedule-off.png')); ?>"
                                                data-title-on="<?php echo e(translate('Want_to_enable')); ?> <strong><?php echo e(translate('customer_date_order_sratus')); ?></strong>?"
                                                data-title-off="<?php echo e(translate('Want_to_disable')); ?> <strong><?php echo e(translate('customer_date_order_sratus')); ?></strong>?"
                                                data-text-on="<p><?php echo e(translate('If_enabled,_customers_can_not_select_schedule_date_over_the_given_days.')); ?></p>"
                                                data-text-off="<p><?php echo e(translate('If_disabled,_customers_can_select_any_schedule_date.')); ?></p>"
                                                class="toggle-switch-input dynamic-checkbox-toggle"

                                                    value="1"
                                                            name="customer_date_order_sratus" id="customer_date_order_sratus"
                                                        <?php echo e($customer_date_order_sratus == 1 ? 'checked' : ''); ?>>
                                                    <span class="toggle-switch-label text">
                                                        <span class="toggle-switch-indicator"></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>



                                        <div class="col-sm-6 col-lg-4">
                                            <?php ($customer_order_date = \App\Models\BusinessSetting::where('key', 'customer_order_date')->first()); ?>
                                            <div class="form-group mb-0">
                                                <label class="input-label text-capitalize d-flex alig-items-center"
                                                    for="customer_order_date">
                                                    <span class="pr-1 d-flex align-items-center switch--label">
                                                        <span class="line--limit-1">
                                                            <?php echo e(translate('Customer_Can_Order_Within')); ?> (<?php echo e(translate('messages.Days')); ?>)
                                                        </span>
                                                        <span class="form-label-secondary text-danger"
                                                        data-toggle="tooltip" data-placement="right"
                                                        data-original-title="<?php echo e(translate('customers_can_not_select_schedule_date_over_this_given_days')); ?>"><img
                                                            src="<?php echo e(dynamicAsset('/public/assets/admin/img/info-circle.svg')); ?>"
                                                            alt="<?php echo e(translate('customers_can_not_select_schedule_date_over_this_given_days')); ?>"></span>
                                                    </span>
                                                </label>
                                                <div class="d-flex">
                                                    <input type="number"  name="customer_order_date" class="form-control mr-3"
                                                    id="customer_order_date" <?php echo e($customer_date_order_sratus == 1 ? 'required' :'readonly'); ?>

                                                    value="<?php echo e($customer_order_date?->value); ?>"
                                                    min="0" >
                                                </div>
                                            </div>
                                        </div>
                                 


                                    </div>

                                    <div class="btn--container justify-content-end mt-3">
                                        <button type="reset" class="btn btn--reset"><?php echo e(translate('messages.reset')); ?></button>
                                        <button type="<?php echo e(env('APP_MODE') != 'demo' ? 'submit' : 'button'); ?>"
                                            class="btn btn--primary call-demo"><?php echo e(translate('save_information')); ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>


            <div class="mt-4">
                <h4 class="card-title mb-3">
                    <i class="tio-document-text-outlined mr-1"></i>
                    <?php echo e(translate('Order Cancellation Messages')); ?>

                </h4>
                <div class="card">
                    <div class="card-body">
                <form action="<?php echo e(route('admin.order-cancel-reasons.store')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                        <?php ($language = \App\Models\BusinessSetting::where('key', 'language')->first()); ?>
                        <?php ($language = $language->value ?? null); ?>
                        <?php ($defaultLang = str_replace('_', '-', app()->getLocale())); ?>
                        <?php if($language): ?>
                            <ul class="nav nav-tabs nav--tabs mb-3 border-0">
                                <li class="nav-item">
                                    <a class="nav-link lang_link1 active" href="#"
                                        id="default-link1"><?php echo e(translate('Default')); ?></a>
                                </li>
                                <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-item">
                                        <a class="nav-link lang_link1" href="#"
                                            id="<?php echo e($lang); ?>-link1"><?php echo e(\App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')'); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php endif; ?>
                        <div class="row g-3">
                            <div class="col-sm-6 lang_form1 default-form1">
                                <label for="order_cancellation" class="form-label"><?php echo e(translate('Order Cancellation Reason')); ?>

                                    (<?php echo e(translate('messages.default')); ?>)</label>
                                <input type="text" maxlength="191" class="form-control h--45px" name="reason[]"
                                    id="order_cancellation" placeholder="<?php echo e(translate('Ex:_Item_is_Broken')); ?>">
                                <input type="hidden" name="lang[]" value="default">
                            </div>
                            <?php if($language): ?>
                                <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-sm-6 d-none lang_form1" id="<?php echo e($lang); ?>-form1">
                                        <label for="order_cancellation<?php echo e($lang); ?>" class="form-label"><?php echo e(translate('Order Cancellation Reason')); ?>

                                            (<?php echo e(strtoupper($lang)); ?>)</label>
                                        <input type="text" class="form-control h--45px" maxlength="191" name="reason[]"
                                            id="order_cancellation<?php echo e($lang); ?>" placeholder="<?php echo e(translate('Ex:_Item_is_Broken')); ?>">
                                        <input type="hidden" name="lang[]" value="<?php echo e($lang); ?>">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <div class="col-sm-6">
                                <label for="user_type" class="form-label d-flex">
                                    <span class="line--limit-1"><?php echo e(translate('User Type')); ?> </span>
                                    <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="<?php echo e(translate('Choose_different_Customers_for_different_Order_Cancelation_Reasons,_such_as_Customer,_Restaurant,_Deliveryman,_and_Admin.')); ?>"><img
                                            src="<?php echo e(dynamicAsset('/public/assets/admin/img/info-circle.svg')); ?>"
                                            alt="<?php echo e(translate('messages.prescription_order_status')); ?>"></span>
                                </label>
                                <select id="user_type" name="user_type" class="form-control h--45px" required>
                                    <option value=""><?php echo e(translate('messages.select_user_type')); ?></option>
                                    <option value="admin"><?php echo e(translate('messages.admin')); ?></option>
                                    <option value="restaurant"><?php echo e(translate('messages.restaurant')); ?></option>
                                    <option value="customer"><?php echo e(translate('messages.customer')); ?></option>
                                    <option value="deliveryman"><?php echo e(translate('messages.deliveryman')); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-2">
                            <?php echo e(translate('messages.*Users_cannot_cancel_an_order_if_the_Admin_does_not_specify_a_cause_for_cancellation,_even_though_they_see_the_‘Cancel_Order‘_option._So_Admin_MUST_provide_a_proper_Order_Cancellation_Reason_and_select_the_related_user.')); ?>

                       </div>
                        <div class="btn--container justify-content-end mt-3 mb-4">
                            <button type="reset" class="btn btn--reset"><?php echo e(translate('messages.reset')); ?></button>
                            <button type="<?php echo e(env('APP_MODE') != 'demo' ? 'submit' : 'button'); ?>"
                                class="btn btn--primary call-demo"><?php echo e(translate('Submit')); ?></button>
                        </div>
                    </form>
                        <div class="card">
                            <div class="card-body mb-3">
                                <div class="d-flex flex-wrap justify-content-between align-items-center mb-md-0 mb-3">
                                    <div class="mx-1">
                                        <h5 class="form-label mb-4">
                                            <?php echo e(translate('messages.order_cancellation_reason_list')); ?>

                                        </h5>
                                    </div>
                                </div>

                                <!-- Table -->
                                <div class="card-body p-0">
                                    <div class="table-responsive datatable-custom">
                                        <table id="columnSearchDatatable"
                                            class="table table-borderless table-thead-bordered table-align-middle"
                                            data-hs-datatables-options='{
                                        "isResponsive": false,
                                        "isShowPaging": false,
                                        "paging":false,
                                    }'>
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="border-0"><?php echo e(translate('messages.SL')); ?></th>
                                                    <th class="border-0"><?php echo e(translate('messages.Reason')); ?></th>
                                                    <th class="border-0"><?php echo e(translate('messages.type')); ?></th>
                                                    <th class="border-0"><?php echo e(translate('messages.status')); ?></th>
                                                    <th class="border-0"><?php echo e(translate('messages.Default')); ?></th>
                                                    <th class="border-0 text-center"><?php echo e(translate('messages.action')); ?></th>
                                                </tr>
                                            </thead>

                                            <tbody id="table-div">
                                                <?php $__currentLoopData = $reasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $reason): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($key + $reasons->firstItem()); ?></td>

                                                        <td>
                                                            <span class="d-block font-size-sm text-body" title="<?php echo e($reason->reason); ?>">
                                                                <?php echo e(Str::limit($reason->reason, 25, '...')); ?>

                                                            </span>
                                                        </td>
                                                        <td><?php echo e(Str::title($reason->user_type)); ?></td>
                                                        <td>
                                                            <label class="toggle-switch toggle-switch-sm"
                                                                for="stocksCheckbox<?php echo e($reason->id); ?>">
                                                                <input type="checkbox" <?php echo e($reason->is_default ? 'disabled' : ''); ?>

                                                                       data-url="<?php echo e(route('admin.order-cancel-reasons.status', [$reason['id'], $reason->status ? 0 : 1])); ?>"
                                                                    class="toggle-switch-input redirect-url"
                                                                    id="stocksCheckbox<?php echo e($reason->id); ?>"
                                                                    <?php echo e($reason->status ? 'checked' : ''); ?>>
                                                                <span class="toggle-switch-label">
                                                                    <span class="toggle-switch-indicator"></span>
                                                                </span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <label class="toggle-switch toggle-switch-sm"
                                                                for="defCheckbox<?php echo e($reason->id); ?>">
                                                                <input type="checkbox"
                                                                       data-url="<?php echo e(route('admin.order-cancel-reasons.setDefault', [$reason['id'], $reason->is_default ? 0 : 1])); ?>"
                                                                    class="toggle-switch-input redirect-url"
                                                                    id="defCheckbox<?php echo e($reason->id); ?>"
                                                                    <?php echo e($reason->is_default ? 'checked' : ''); ?>>
                                                                <span class="toggle-switch-label">
                                                                    <span class="toggle-switch-indicator"></span>
                                                                </span>
                                                            </label>
                                                        </td>

                                                        <td>
                                                            <div class="btn--container justify-content-center">

                                                                <a class="btn btn-sm btn--primary btn-outline-primary action-btn edit-reason"
                                                    title="<?php echo e(translate('messages.edit')); ?>"
                                                    data-toggle="modal"
                                                    data-target="#add_update_reason_<?php echo e($reason->id); ?>"><i
                                                        class="tio-edit"></i>
                                                </a>

                                                <?php if(!$reason->is_default): ?>

                                                <a class="btn btn-sm btn--danger btn-outline-danger action-btn form-alert"
                                                    href="javascript:"  disabled
                                                   data-id="order-cancellation-reason-<?php echo e($reason['id']); ?>"
                                                   data-message="<?php echo e(translate('messages.If_you_want_to_delete_this_reason,_please_confirm_your_decision.')); ?>"
                                                    title="<?php echo e(translate('messages.delete')); ?>">
                                                    <i class="tio-delete-outlined"></i>
                                                </a>
                                                <form
                                                    action="<?php echo e(route('admin.order-cancel-reasons.destroy', $reason['id'])); ?>"
                                                    method="post" id="order-cancellation-reason-<?php echo e($reason['id']); ?>">
                                                    <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                                </form>
                                                <?php endif; ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="add_update_reason_<?php echo e($reason->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(translate('messages.order_cancellation_reason')); ?>

                                                                        <?php echo e(translate('messages.Update')); ?></label></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                    <form action="<?php echo e(route('admin.order-cancel-reasons.update')); ?>" method="post">
                                                                <div class="modal-body">
                                                                        <?php echo csrf_field(); ?>
                                                                        <?php echo method_field('put'); ?>

                                                                        <?php ($reason=  \App\Models\OrderCancelReason::withoutGlobalScope('translate')->with('translations')->find($reason->id)); ?>
                                                                        <?php ($language=\App\Models\BusinessSetting::where('key','language')->first()); ?>
                                                                    <?php ($language = $language->value ?? null); ?>
                                                                    <?php ($defaultLang = str_replace('_', '-', app()->getLocale())); ?>
                                                                    <ul class="nav nav-tabs nav--tabs mb-3 border-0">
                                                                        <li class="nav-item">
                                                                            <a class="nav-link update-lang_link add_active active"
                                                                            href="#"
                                                                            id="default-link"><?php echo e(translate('Default')); ?></a>
                                                                        </li>
                                                                        <?php if($language): ?>
                                                                        <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <li class="nav-item">
                                                                                <a class="nav-link update-lang_link"
                                                                                    href="#"
                                                                                   data-reason-id="<?php echo e($reason->id); ?>"
                                                                                    id="<?php echo e($lang); ?>-link"><?php echo e(\App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')'); ?></a>
                                                                            </li>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php endif; ?>
                                                                    </ul>
                                                                        <input type="hidden" name="reason_id"  value="<?php echo e($reason->id); ?>" />

                                                                        <div class="form-group mb-3 add_active_2  update-lang_form" id="default-form_<?php echo e($reason->id); ?>">
                                                                            <label for="reason" class="form-label"><?php echo e(translate('Order Cancellation Reason')); ?> (<?php echo e(translate('messages.default')); ?>) </label>
                                                                            <input id="reason" class="form-control" name='reason[]' value="<?php echo e($reason?->getRawOriginal('reason')); ?>" type="text">
                                                                            <input type="hidden" name="lang1[]" value="default">
                                                                        </div>
                                                                                        <?php if($language): ?>
                                                                                            <?php $__empty_1 = true; $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                                                            <?php
                                                                                                if($reason?->translations){
                                                                                                    $translate = [];
                                                                                                    foreach($reason?->translations as $t)
                                                                                                    {
                                                                                                        if($t->locale == $lang && $t->key=="reason"){
                                                                                                            $translate[$lang]['reason'] = $t->value;
                                                                                                        }
                                                                                                    }
                                                                                                }

                                                                                                ?>
                                                                                                <div class="form-group mb-3 d-none update-lang_form" id="<?php echo e($lang); ?>-langform_<?php echo e($reason->id); ?>">
                                                                                                    <label for="reason<?php echo e($lang); ?>" class="form-label"><?php echo e(translate('Order Cancellation Reason')); ?> (<?php echo e(strtoupper($lang)); ?>)</label>
                                                                                                    <input id="reason<?php echo e($lang); ?>" class="form-control" name='reason[]' placeholder="<?php echo e(translate('Ex:_Item_is_Broken')); ?>" value="<?php echo e($translate[$lang]['reason'] ?? null); ?>"  type="text">
                                                                                                    <input type="hidden" name="lang1[]" value="<?php echo e($lang); ?>">
                                                                                                </div>
                                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                                                                <?php endif; ?>
                                                                                                <?php endif; ?>

                                                                        <select name="user_type"  class="form-control h--45px"
                                                                            required>
                                                                            <option value=""><?php echo e(translate('messages.select_user_type')); ?></option>
                                                                            <option <?php echo e($reason->user_type == 'admin' ? 'selected': ''); ?> value="admin"><?php echo e(translate('messages.admin')); ?></option>
                                                                            <option <?php echo e($reason->user_type == 'restaurant' ? 'selected': ''); ?> value="restaurant"><?php echo e(translate('messages.restaurant')); ?></option>
                                                                            <option <?php echo e($reason->user_type == 'customer' ? 'selected': ''); ?> value="customer"><?php echo e(translate('messages.customer')); ?></option>
                                                                            <option <?php echo e($reason->user_type == 'deliveryman' ? 'selected': ''); ?> value="deliveryman"><?php echo e(translate('messages.deliveryman')); ?></option>
                                                                        </select>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(translate('Close')); ?></button>
                                                                    <button type="submit" class="btn btn-primary"><?php echo e(translate('Save_changes')); ?></button>
                                                                </div>
                                                                    </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- End Table -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(dynamicAsset('public/assets/admin/js/view-pages/business-settings-order-page.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/business-settings/order-index.blade.php ENDPATH**/ ?>