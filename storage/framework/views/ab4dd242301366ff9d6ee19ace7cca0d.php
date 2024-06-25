<?php $__env->startSection('title',translate('messages.Payment Method')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->

        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/payment.png')); ?>" class="w--22" alt="">
                </span>
                <span>
                    <?php echo e(translate('messages.payment_gateway_setup')); ?>

                </span>
            </h1>
            <?php echo $__env->make('admin-views.business-settings.partials.third-party-links', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="d-flex flex-wrap justify-content-end align-items-center flex-grow-1">
                <div class="blinkings trx_top active">
                    <i class="tio-info-outined"></i>
                    <div class="business-notes">
                        <h6><img src="<?php echo e(dynamicAsset('/public/assets/admin/img/notes.png')); ?>" alt=""> <?php echo e(translate('Note')); ?></h6>
                        <div>
                            <?php echo e(translate('Without configuring this section functionality will not work properly. Thus the whole system will not work as it planned')); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="card border-0">
            <div class="card-header card-header-shadow">
                <h5 class="card-title align-items-center">
                    <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/payment-method.png')); ?>" class="mr-1" alt="">
                    <?php echo e(translate('Payment Method')); ?>

                </h5>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-4">
                        <?php ($config=\App\CentralLogics\Helpers::get_business_settings('cash_on_delivery')); ?>
                        <form action="<?php echo e(route('admin.business-settings.payment-method-update',['cash_on_delivery'])); ?>"
                            method="post" id="cash_on_delivery_status_form">
                            <?php echo csrf_field(); ?>
                            <label class="toggle-switch h--45px toggle-switch-sm d-flex justify-content-between border rounded px-3 py-0 form-control">
                                <span class="pr-1 d-flex align-items-center switch--label">
                                    <span class="line--limit-1">
                                        <?php echo e(translate('Cash On Delivery')); ?>

                                    </span>
                                    <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('If_enabled_Customers_will_be_able_to_select_COD_as_a_payment_method_during_checkout')); ?>"><img src="<?php echo e(dynamicAsset('public/assets/admin/img/info-circle.svg')); ?>" alt="Veg/non-veg toggle"> * </span>
                                </span>
                                <input type="hidden" name="toggle_type" value="cash_on_delivery">
                                <input
                                    type="checkbox" id="cash_on_delivery_status"
                                    data-id="cash_on_delivery_status"
                                    data-type="status"
                                    data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/digital-payment-on.png')); ?>"
                                    data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/digital-payment-off.png')); ?>"
                                    data-title-on="<?php echo e(translate('By Turning ON Cash On Delivery Option')); ?>"
                                    data-title-off="<?php echo e(translate('By Turning OFF Cash On Delivery Option')); ?>"
                                    data-text-on="<p><?php echo e(translate('Customers will not be able to select COD as a payment method during checkout. Please review your settings and enable COD if you wish to offer this payment option to customers.')); ?></p>"
                                    data-text-off="<p><?php echo e(translate('Customers will be able to select COD as a payment method during checkout.')); ?></p>"
                                    class="status toggle-switch-input dynamic-checkbox"
                                       name="status" value="1" <?php echo e($config?($config['status']==1?'checked':''):''); ?>>
                                <span class="toggle-switch-label text">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <?php ($digital_payment=\App\CentralLogics\Helpers::get_business_settings('digital_payment')); ?>
                        <form action="<?php echo e(route('admin.business-settings.payment-method-update',['digital_payment'])); ?>"
                            method="post" id="digital_payment_status_form">
                            <?php echo csrf_field(); ?>
                            <label class="toggle-switch h--45px toggle-switch-sm d-flex justify-content-between border rounded px-3 py-0 form-control">
                                <span class="pr-1 d-flex align-items-center switch--label">
                                    <span class="line--limit-1">
                                        <?php echo e(translate('digital payment')); ?>

                                    </span>
                                    <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('If_enabled_Customers_will_be_able_to_select_digital_payment_as_a_payment_method_during_checkout')); ?>"><img src="<?php echo e(dynamicAsset('public/assets/admin/img/info-circle.svg')); ?>" alt="Veg/non-veg toggle"> * </span>
                                </span>
                                <input type="hidden" name="toggle_type" value="digital_payment">
                                <input  type="checkbox" id="digital_payment_status"
                                       data-id="digital_payment_status"
                                       data-type="status"
                                       data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/digital-payment-on.png')); ?>"
                                       data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/digital-payment-off.png')); ?>"
                                       data-title-on="<?php echo e(translate('By Turning ON Digital Payment Option')); ?>"
                                       data-title-off="<?php echo e(translate('By Turning OFF Digital Payment Option')); ?>"
                                       data-text-on="<p><?php echo e(translate('Customers will not be able to select digital payment as a payment method during checkout. Please review your settings and enable digital payment if you wish to offer this payment option to customers.')); ?></p>"
                                       data-text-off="<p><?php echo e(translate('Customers will be able to select digital payment as a payment method during checkout.')); ?></p>"
                                       class="status toggle-switch-input dynamic-checkbox"
                                       name="status" value="1" <?php echo e($digital_payment?($digital_payment['status']==1?'checked':''):''); ?>>
                                <span class="toggle-switch-label text">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <?php ($Offline_Payment=\App\CentralLogics\Helpers::get_business_settings('offline_payment_status')); ?>
                        <form action="<?php echo e(route('admin.business-settings.payment-method-update',['offline_payment_status'])); ?>"
                            method="post" id="offline_payment_status_form">
                            <?php echo csrf_field(); ?>
                            <label class="toggle-switch h--45px toggle-switch-sm d-flex justify-content-between border rounded px-3 py-0 form-control">
                                <span class="pr-1 d-flex align-items-center switch--label">
                                    <span class="line--limit-1">
                                        <?php echo e(translate('Offline_Payment')); ?>

                                    </span>
                                    <span class="form-label-secondary text-danger d-flex" data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('If_enabled_Customers_will_be_able_to_select_offline_payment_as_a_payment_method_during_checkout')); ?>"><img src="<?php echo e(dynamicAsset('public/assets/admin/img/info-circle.svg')); ?>" alt="Veg/non-veg toggle"> * </span>
                                </span>
                                <input type="hidden" name="toggle_type" value="offline_payment_status" >
                                <input  type="checkbox" id="offline_payment_status"
                                        data-id="offline_payment_status"
                                        data-type="status"
                                        data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/digital-payment-on.png')); ?>"
                                        data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/digital-payment-off.png')); ?>"
                                        data-title-on="<?php echo e(translate('By_Turning_ON_Offline_Payment_Option')); ?>"
                                        data-title-off="<?php echo e(translate('By_Turning_OFF_Offline_Payment_Option')); ?>"
                                        data-text-on="<p><?php echo e(translate('Customers_will_be_able_to_select_Offline_Payment_as_a_payment_method_during_checkout')); ?></p>"
                                        data-text-off="<p><?php echo e(translate('Customers_will_not_be_able_to_select_Offline_Payment_as_a_payment_method_during_checkout._Please_review_your_settings_and_enable_Offline_Payment_if_you_wish_to_offer_this_payment_option_to_customers.')); ?></p>"
                                        class="status toggle-switch-input dynamic-checkbox"

                                        name="status" value="1" <?php echo e($Offline_Payment == 1?'checked':''); ?>>
                                <span class="toggle-switch-label text">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php if($published_status == 1): ?>
        <br>
        <div>
            <div class="card">
                <div class="card-body d-flex flex-wrap justify-content-around">
                    <h4 class="w-50 flex-grow-1 module-warning-text">
                        <i class="tio-info-outined"></i>
                    <?php echo e(translate('Your_current_payment_settings_are_disabled,_because_you_have_enabled_payment_gateway_addon,_To_visit_your_currently_active_payment_gateway_settings_please_follow_the_link.')); ?></h4>
                    <div>
                        <a href="<?php echo e(!empty($payment_url) ? $payment_url : ''); ?>" class="btn btn-outline-primary"> <i class="tio-settings"></i> <?php echo e(translate('Settings')); ?></a>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php ($is_published = $published_status == 1 ? 'inactive' : ''); ?>
        <!-- Tab Content -->
        <div class="row digital_payment_methods  <?php echo e($is_published); ?> mt-3 g-3">
            <?php $__currentLoopData = $data_values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_key => $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <form action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.payment-method-update'):'javascript:'); ?>" method="POST"
                              id="<?php echo e($payment->key_name); ?>-form" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="card-header d-flex flex-wrap align-content-around">
                                <h5>
                                    <span class="text-uppercase"><?php echo e(str_replace('_',' ',$payment->key_name)); ?></span>
                                </h5>
                                <label class="switch--custom-label toggle-switch toggle-switch-sm d-inline-flex">
                                    <span
                                        class="mr-2 switch--custom-label-text text-primary on text-uppercase"><?php echo e(translate('on')); ?></span>
                                    <span class="mr-2 switch--custom-label-text off text-uppercase"><?php echo e(translate('off')); ?></span>
                                    <input type="checkbox" name="status" value="1"
                                           class="toggle-switch-input" <?php echo e($payment['is_active']==1?'checked':''); ?>>
                                    <span class="toggle-switch-label text">
                                            <span class="toggle-switch-indicator"></span>
                                        </span>
                                </label>
                            </div>

                            <?php ($additional_data = $payment['additional_data'] != null ? json_decode($payment['additional_data']) : []); ?>
                            <div class="card-body">
                                <div class="payment--gateway-img">
                                    <img  id="<?php echo e($payment->key_name); ?>-image-preview" class="__height-80 onerror-image"
                                    data-onerror-image="<?php echo e(dynamicAsset('/public/assets/admin/img/blank3.png')); ?>"

                                <?php if($additional_data != null): ?>
                                    src="<?php echo e(\App\CentralLogics\Helpers::onerror_image_helper(
                                        $additional_data?->gateway_image,
                                        dynamicStorage('storage/app/public/payment_modules/gateway_image').'/'.$additional_data?->gateway_image,
                                        dynamicAsset('/public/assets/admin/img/blank3.png'),
                                        'payment_modules/gateway_image/'
                                    )); ?>"

                                <?php else: ?>
                                src="<?php echo e(dynamicAsset('/public/assets/admin/img/blank3.png')); ?>"
                                <?php endif; ?>
                                alt="public">
                                </div>

                                <input name="gateway" value="<?php echo e($payment->key_name); ?>" class="d-none">

                                <?php ($mode=$data_values->where('key_name',$payment->key_name)->first()->live_values['mode']); ?>
                                <div class="form-floating mb-2" >
                                    <select class="js-select form-control theme-input-style w-100" name="mode">
                                        <option value="live" <?php echo e($mode=='live'?'selected':''); ?>><?php echo e(translate('Live')); ?></option>
                                        <option value="test" <?php echo e($mode=='test'?'selected':''); ?>><?php echo e(translate('Test')); ?></option>
                                    </select>
                                </div>

                                <?php ($skip=['gateway','mode','status']); ?>
                                <?php $__currentLoopData = $data_values->where('key_name',$payment->key_name)->first()->live_values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!in_array($key,$skip)): ?>
                                        <div class="form-floating mb-2" >
                                            <label for="<?php echo e($payment_key); ?>-<?php echo e($key); ?>"
                                                   class="form-label"><?php echo e(ucwords(str_replace('_',' ',$key))); ?>

                                                *</label>
                                            <input id="<?php echo e($payment_key); ?>-<?php echo e($key); ?>" type="text" class="form-control"
                                                   name="<?php echo e($key); ?>"
                                                   placeholder="<?php echo e(ucwords(str_replace('_',' ',$key))); ?> *"
                                                   value="<?php echo e(env('APP_ENV')=='demo'?'':$value); ?>">
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <?php if($payment['key_name'] == 'paystack'): ?>
                                    <div class="form-floating mb-2" >
                                        <label for="Callback_Url" class="form-label"><?php echo e(translate('Callback Url')); ?></label>
                                        <input id="Callback_Url" type="text"
                                               class="form-control"
                                               placeholder="<?php echo e(translate('Callback Url')); ?> *"
                                               readonly
                                               value="<?php echo e(env('APP_ENV')=='demo'?'': route('paystack.callback')); ?>" <?php echo e($is_published); ?>>
                                    </div>
                                <?php endif; ?>

                                <div class="form-floating mb-2" >
                                    <label for="payment_gateway_title-<?php echo e($payment_key); ?>"
                                           class="form-label"><?php echo e(translate('payment_gateway_title')); ?></label>
                                    <input type="text" class="form-control"
                                           name="gateway_title" id="payment_gateway_title-<?php echo e($payment_key); ?>"
                                           placeholder="<?php echo e(translate('payment_gateway_title')); ?>"
                                           value="<?php echo e($additional_data != null ? $additional_data->gateway_title : ''); ?>">
                                </div>

                                <div class="form-floating mb-2" >
                                    <label for="exampleFormControlInput1"
                                           class="form-label"><?php echo e(translate('Choose_logo')); ?></label>
                                    <input type="file" class="form-control" name="gateway_image" id="<?php echo e($payment->key_name); ?>-image" accept=".jpg, .png, .jpeg|image/*">
                                </div>

                                <div class="text-right mt-2 "  >
                                    <button type="submit" class="btn btn-primary px-5"><?php echo e(translate('save')); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <!-- End Tab Content -->
    </div>





<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(dynamicAsset('public/assets/admin/js/view-pages/business-settings-payment-page.js')); ?>"></script>
<script>
    "use strict";
    <?php if(!isset($digital_payment) || $digital_payment['status']==0): ?>
        $('.digital_payment_methods').hide();
    <?php endif; ?>
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/business-settings/payment-index.blade.php ENDPATH**/ ?>