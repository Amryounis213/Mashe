<?php $__env->startSection('title',translate('SMS Module Setup')); ?>


<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="<?php echo e(dynamicAsset('public/assets/admin/img/sms.png')); ?>" class="w--26" alt="">
                </span>
                <span>
                    <?php echo e(translate('messages.sms_gateway_setup')); ?>

                </span>
            </h1>
            <?php echo $__env->make('admin-views.business-settings.partials.third-party-links', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <!-- End Page Header -->

        <div class="row g-3">

            <?php if($published_status == 1): ?>
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-body  d-flex flex-wrap  justify-content-around">
                            <h4  class="w-50 flex-grow-1 module-warning-text">
                                <i class="tio-info-outined"></i>
                                <?php echo e(translate('Your_current_sms_settings_are_disabled,_because_you_have_enabled_sms_gateway_addon,_To_visit_your_currently_active_sms_gateway_settings_please_follow_the_link.')); ?>

                            </h4>
                            <div>
                                <a href="<?php echo e(!empty($payment_url) ? $payment_url : ''); ?>" class="btn btn-outline-primary"> <i class="tio-settings"></i> <?php echo e(translate('settings')); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php ($is_published = $published_status == 1 ? 'inactive' : ''); ?>
            <?php $__currentLoopData = $data_values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 digital_payment_methods  <?php echo e($is_published); ?> mb-3" >
                    <div class="card">
                        <div class="card-header">
                            <h4 class="page-title text-capitalize"><?php echo e(translate($gateway->key_name)); ?></h4>
                        </div>
                        <div class="card-body p-30">
                            <form action="<?php echo e(route('admin.business-settings.sms-module-update',[$gateway->key_name])); ?>" method="POST"
                                  id="<?php echo e($gateway->key_name); ?>-form" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('post'); ?>
                                <div class="discount-type">
                                    <div class="d-flex align-items-center gap-4 gap-xl-5 mb-30">
                                        <div class="custom-radio">
                                            <input type="radio" id="<?php echo e($gateway->key_name); ?>-active"
                                                   name="status"
                                                   value="1" <?php echo e($data_values->where('key_name',$gateway->key_name)->first()->live_values['status']?'checked':''); ?>>
                                            <label
                                                for="<?php echo e($gateway->key_name); ?>-active"> <?php echo e(translate('messages.Active')); ?></label>
                                        </div>
                                        <div class="custom-radio">
                                            <input type="radio" id="<?php echo e($gateway->key_name); ?>-inactive"
                                                   name="status"
                                                   value="0" <?php echo e($data_values->where('key_name',$gateway->key_name)->first()->live_values['status']?'':'checked'); ?>>
                                            <label
                                                for="<?php echo e($gateway->key_name); ?>-inactive"> <?php echo e(translate('messages.Inactive')); ?></label>
                                        </div>
                                    </div>

                                    <input name="gateway" value="<?php echo e($gateway->key_name); ?>" class="d-none">
                                    <input name="mode" value="live" class="d-none">

                                    <?php ($skip=['gateway','mode','status']); ?>
                                    <?php $__currentLoopData = $data_values->where('key_name',$gateway->key_name)->first()->live_values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(!in_array($key,$skip)): ?>
                                            <div class="form-floating mb-30 mt-30 text-capitalize">
                                                <label for="<?php echo e($key); ?>" class="form-label"><?php echo e(translate($key)); ?> *</label>
                                                <input id="<?php echo e($key); ?>" type="text" class="form-control"
                                                       name="<?php echo e($key); ?>"
                                                       placeholder=" <?php echo e($key == 'otp_template' ?  translate('Your_Security_Pin_is'). ' #OTP#' : translate($key) .' *'); ?>    "
                                                       value="<?php echo e(env('APP_ENV')=='demo'?'':$value); ?>">
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn--primary demo_check">
                                        <?php echo e(translate('messages.Update')); ?>

                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/business-settings/sms-index.blade.php ENDPATH**/ ?>