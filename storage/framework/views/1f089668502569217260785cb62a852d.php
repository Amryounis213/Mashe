<?php $__env->startSection('title', translate('Restaurant_setup')); ?>


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
                                <?php echo e(translate('Don’t_forget_to_click_the_respective_‘Save_Information’_buttons_below_to_save_changes')); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo $__env->make('admin-views.business-settings.partials.nav-menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <form action="<?php echo e(route('admin.business-settings.update-restaurant')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php ($name = \App\Models\BusinessSetting::where('key', 'business_name')->first()); ?>

            <div class="row g-3">
                <?php ($default_location = \App\Models\BusinessSetting::where('key', 'default_location')->first()); ?>
                <?php ($default_location = $default_location->value ? json_decode($default_location->value, true) : 0); ?>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-3 align-items-end">
                                <div class="col-lg-4 col-sm-6">
                                    <?php ($canceled_by_restaurant = \App\Models\BusinessSetting::where('key', 'canceled_by_restaurant')->first()); ?>
                                    <?php ($canceled_by_restaurant = $canceled_by_restaurant ? $canceled_by_restaurant->value : 0); ?>
                                    <div class="form-group mb-0">
                                        <label class="input-label text-capitalize d-flex alig-items-center"><span
                                                class="line--limit-1"><?php echo e(translate('Can_a_Restaurant_Cancel_Order')); ?>

                                            </span><span class="input-label-secondary text--title" data-toggle="tooltip"
                                                data-placement="right"
                                                data-original-title="<?php echo e(translate('Admin_can_enable/disable_restaurants’_order_cancellation_option.')); ?>">
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
                                                    <?php echo e($canceled_by_restaurant == 0 ? 'checked' : ''); ?>>
                                                <span class="form-check-label">
                                                    <?php echo e(translate('no')); ?>

                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <?php ($restaurant_self_registration = \App\Models\BusinessSetting::where('key', 'toggle_restaurant_registration')->first()); ?>
                                    <?php ($restaurant_self_registration = $restaurant_self_registration ? $restaurant_self_registration->value : 0); ?>
                                    <div class="form-group mb-0">

                                        <label
                                            class="toggle-switch h--45px toggle-switch-sm d-flex justify-content-between border rounded px-3 py-0 form-control">
                                            <span class="pr-1 d-flex align-items-center switch--label">
                                                <span class="line--limit-1">
                                                    <?php echo e(translate('messages.restaurant_self_registration')); ?>

                                                </span>
                                                <span class="form-label-secondary text-danger d-flex"
                                                    data-toggle="tooltip" data-placement="right"
                                                    data-original-title="<?php echo e(translate('If_enabled,_a_restaurant_can_send_a_registration_request_through_their_restaurant_or_customer_app,_website,_or_admin_landing_page._The_admin_will_receive_an_email_notification_and_can_accept_or_reject_the_request')); ?>"><img
                                                        src="<?php echo e(dynamicAsset('/public/assets/admin/img/info-circle.svg')); ?>"
                                                        alt="<?php echo e(translate('messages.restaurant_self_registration')); ?>"> *
                                                </span>
                                            </span>
                                            <input type="checkbox"

                                            data-id="restaurant_self_registration1"
                                            data-type="toggle"
                                            data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/store-self-reg-on.png')); ?>"
                                            data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/store-self-reg-off.png')); ?>"
                                            data-title-on="<?php echo e(translate('Want_to_enable')); ?> <strong><?php echo e(translate('restaurant Self Registration')); ?></strong> ?"
                                            data-title-off="<?php echo e(translate('Want_to_disable')); ?> <strong><?php echo e(translate('restaurant Self Registration')); ?></strong> ?"
                                            data-text-on="<p><?php echo e(translate('If_enabled,_restaurants_can_do_self-registration_from_the_restaurant_or_customer_app_or_website')); ?></p>"
                                            data-text-off="<p><?php echo e(translate('If_disabled,_the_restaurant_Self-Registration_feature_will_be_hidden_from_the_restaurant_or_customer_app,_website,_and_admin_landing_page')); ?></p>"
                                            class="toggle-switch-input dynamic-checkbox-toggle"

                                            value="1"
                                                name="restaurant_self_registration" id="restaurant_self_registration1"
                                                <?php echo e($restaurant_self_registration == 1 ? 'checked' : ''); ?>>
                                            <span class="toggle-switch-label text">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <?php ($restaurant_review_reply = \App\Models\BusinessSetting::where('key', 'restaurant_review_reply')->first()); ?>
                                    <?php ($restaurant_review_reply = $restaurant_review_reply ? $restaurant_review_reply->value : 0); ?>
                                    <div class="form-group mb-0">

                                        <label
                                            class="toggle-switch h--45px toggle-switch-sm d-flex justify-content-between border rounded px-3 py-0 form-control">
                                            <span class="pr-1 d-flex align-items-center switch--label">
                                                <span class="line--limit-1">
                                                    <?php echo e(translate('Restaurant Can Reply Review')); ?>

                                                </span>
                                                <span class="form-label-secondary text-danger d-flex"
                                                    data-toggle="tooltip" data-placement="right"
                                                    data-original-title="<?php echo e(translate('If_enabled,_a_restaurant_can_reply_to_a_review')); ?>"><img
                                                        src="<?php echo e(dynamicAsset('/public/assets/admin/img/info-circle.svg')); ?>"
                                                        alt="<?php echo e(translate('messages.restaurant_review_reply')); ?>">
                                                </span>
                                            </span>
                                            <input type="checkbox"

                                            data-id="restaurant_review_reply1"
                                            data-type="toggle"
                                            data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/store-self-reg-on.png')); ?>"
                                            data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/store-self-reg-off.png')); ?>"
                                            data-title-on="<?php echo e(translate('Want_to_enable')); ?> <strong><?php echo e(translate('restaurant Reply Review')); ?></strong> ?"
                                            data-title-off="<?php echo e(translate('Want_to_disable')); ?> <strong><?php echo e(translate('restaurant Reply Review')); ?></strong> ?"
                                            data-text-on="<p><?php echo e(translate('If_enabled,_a_restaurant_can_reply_to_a_review')); ?></p>"
                                            data-text-off="<p><?php echo e(translate('If_disabled,_a_restaurant_can_not_reply_to_a_review')); ?></p>"
                                            class="toggle-switch-input dynamic-checkbox-toggle"

                                            value="1"
                                                name="restaurant_review_reply" id="restaurant_review_reply1"
                                                <?php echo e($restaurant_review_reply == 1 ? 'checked' : ''); ?>>
                                            <span class="toggle-switch-label text">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-4">
                                    <?php ($extra_packaging_charge = \App\Models\BusinessSetting::where('key', 'extra_packaging_charge')->first()); ?>
                                    <?php ($extra_packaging_charge = $extra_packaging_charge ? $extra_packaging_charge->value : 0); ?>
                                    <div class="form-group mb-0">
                                        <label
                                            class="toggle-switch h--45px toggle-switch-sm d-flex justify-content-between border rounded px-3 py-0 form-control">
                                            <span class="pr-1 d-flex align-items-center switch--label">
                                                <span class="line--limit-1">
                                                    <?php echo e(translate('messages.Restaurant Can Enable Extra Packaging Charge')); ?>

                                                </span>
                                                <span class="form-label-secondary text-danger d-flex"
                                                      data-toggle="tooltip" data-placement="right"
                                                      data-original-title="<?php echo e(translate('With_this_feature,_restaurant_will_get_the_option_to_offer_extra_packaging_charge_to_the_customer.')); ?>"><img
                                                        src="<?php echo e(dynamicAsset('/public/assets/admin/img/info-circle.svg')); ?>"
                                                        alt="<?php echo e(translate('messages.extra_packaging_charge_toggle')); ?>">
                                                </span>
                                            </span>
                                            <input type="checkbox"

                                                   data-id="extra_packaging_charge"
                                                   data-type="toggle"
                                                   data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/veg-on.png')); ?>"
                                                   data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/veg-off.png')); ?>"
                                                   data-title-on="<?php echo e(translate('want_to_enable')); ?> <strong><?php echo e(translate('extra_packaging_charge')); ?></strong>?"
                                                   data-title-off="<?php echo e(translate('want_to_disable')); ?> <strong><?php echo e(translate('extra_packaging_charge')); ?></strong>?"
                                                   data-text-on="<p><?php echo e(translate('if_enabled,_restaurant_will_get_the_option_to_offer_extra_packaging_charge_to_the_customer')); ?></p>"
                                                   data-text-off="<p><?php echo e(translate('if_disabled,_restaurant_will_not_get_the_option_to_offer_extra_packaging_charge_to_the_customer')); ?></p>"
                                                   class="toggle-switch-input dynamic-checkbox-toggle"

                                                   value="1"
                                                   name="extra_packaging_charge" id="extra_packaging_charge"
                                                <?php echo e($extra_packaging_charge == 1 ? 'checked' : ''); ?>>
                                            <span class="toggle-switch-label text">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <?php ($cash_in_hand_overflow = \App\Models\BusinessSetting::where('key', 'cash_in_hand_overflow_restaurant')->first()); ?>
                                    <?php ($cash_in_hand_overflow = $cash_in_hand_overflow ? $cash_in_hand_overflow->value : 0); ?>
                                    <div class="form-group mb-0">

                                        <label
                                            class="toggle-switch h--45px toggle-switch-sm d-flex justify-content-between border rounded px-3 py-0 form-control">
                                            <span class="pr-1 d-flex align-items-center switch--label">
                                                <span class="line--limit-1">
                                                    <?php echo e(translate('messages.Cash_In_Hand_Overflow')); ?>

                                                </span>
                                                <span class="form-label-secondary text-danger d-flex"
                                                    data-toggle="tooltip" data-placement="right"
                                                    data-original-title="<?php echo e(translate('If_enabled,_restaurants_will_be_automatically_suspended_by_the_system_when_their_‘Cash_in_Hand’_limit_is_exceeded.')); ?>"><img
                                                        src="<?php echo e(dynamicAsset('/public/assets/admin/img/info-circle.svg')); ?>"
                                                        alt="<?php echo e(translate('messages.cash_in_hand_overflow')); ?>"> *
                                                </span>
                                            </span>
                                            <input type="checkbox"

                                            data-id="cash_in_hand_overflow"
                                                data-type="toggle"
                                                data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/show-earning-in-apps-on.png')); ?>"
                                                data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/show-earning-in-apps-off.png')); ?>"
                                                data-title-on="<?php echo e(translate('Want_to_enable')); ?> <strong><?php echo e(translate('Cash_In_Hand_Overflow')); ?></strong> ?"
                                                data-title-off="<?php echo e(translate('Want_to_disable')); ?> <strong><?php echo e(translate('Cash_In_Hand_Overflow')); ?></strong>  ?"
                                                data-text-on="<p><?php echo e(translate('If_enabled,_restaurants_have_to_provide_collected_cash_by_them_self')); ?></p>"
                                                data-text-off="<p><?php echo e(translate('If_disabled,_restaurants_do_not_have_to_provide_collected_cash_by_them_self')); ?></p>"
                                                class="toggle-switch-input dynamic-checkbox-toggle"


                                            value="1"
                                                name="cash_in_hand_overflow_restaurant" id="cash_in_hand_overflow"
                                                <?php echo e($cash_in_hand_overflow == 1 ? 'checked' : ''); ?>>
                                            <span class="toggle-switch-label text">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>





                                <div class="col-lg-4 col-sm-6">
                                    <?php ($cash_in_hand_overflow_restaurant_amount = \App\Models\BusinessSetting::where('key', 'cash_in_hand_overflow_restaurant_amount')->first()); ?>
                                    <div class="form-group mb-0">
                                        <label class=" text-capitalize"
                                            for="cash_in_hand_overflow_restaurant_amount">
                                            <span>
                                                <?php echo e(translate('Maximum_Amount_to_Hold_Cash_in_Hand')); ?> (<?php echo e(\App\CentralLogics\Helpers::currency_symbol()); ?>)

                                            </span>

                                            <span class="form-label-secondary"
                                            data-toggle="tooltip" data-placement="right"
                                            data-original-title="<?php echo e(translate('Enter_the_maximum_cash_amount_restaurants_can_hold._If_this_number_exceeds,_restaurants_will_be_suspended_and_not_receive_any_orders.')); ?>"><img
                                                src="<?php echo e(dynamicAsset('/public/assets/admin/img/info-circle.svg')); ?>"
                                                alt="<?php echo e(translate('messages.dm_cancel_order_hint')); ?>"></span>
                                        </label>
                                        <input type="number" name="cash_in_hand_overflow_restaurant_amount" class="form-control"
                                            id="cash_in_hand_overflow_restaurant_amount" min="0" step=".001"
                                            value="<?php echo e($cash_in_hand_overflow_restaurant_amount ? $cash_in_hand_overflow_restaurant_amount->value : ''); ?>"  <?php echo e($cash_in_hand_overflow  == 1 ? 'required' : 'readonly'); ?> >
                                    </div>
                                </div>


                                <div class="col-lg-4 col-sm-6">
                                    <?php ($min_amount_to_pay_restaurant = \App\Models\BusinessSetting::where('key', 'min_amount_to_pay_restaurant')->first()); ?>
                                    <div class="form-group mb-0">
                                        <label class=" text-capitalize"
                                            for="min_amount_to_pay_restaurant">
                                            <span>
                                                <?php echo e(translate('Minimum_Amount_To_Pay')); ?> (<?php echo e(\App\CentralLogics\Helpers::currency_symbol()); ?>)
                                            </span>
                                            <span class="form-label-secondary"
                                            data-toggle="tooltip" data-placement="right"
                                            data-original-title="<?php echo e(translate('Enter_the_minimum_cash_amount_restaurants_can_pay')); ?>"><img
                                                src="<?php echo e(dynamicAsset('/public/assets/admin/img/info-circle.svg')); ?>"
                                                alt="<?php echo e(translate('messages.dm_cancel_order_hint')); ?>"></span>
                                        </label>
                                        <input type="number" name="min_amount_to_pay_restaurant" class="form-control"
                                            id="min_amount_to_pay_restaurant" min="0" step=".001"
                                            value="<?php echo e($min_amount_to_pay_restaurant ? $min_amount_to_pay_restaurant->value : ''); ?>"  <?php echo e($cash_in_hand_overflow  == 1 ? 'required' : 'readonly'); ?> >
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


        </form>
    </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/business-settings/restaurant-index.blade.php ENDPATH**/ ?>