<?php $__env->startSection('title', translate('messages.react_site_setup')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-sm-0">
                    <h1 class="page-header-title"><?php echo e(translate('React Site Setup')); ?></h1>
                </div>
            </div>
        </div>
        <?php ($react_setup=\App\Models\BusinessSetting::where(['key'=>'react_setup'])->first()); ?>
        <?php ($react_setup=$react_setup?json_decode($react_setup->value, true):null); ?>
        <?php if(old('invalid-data') || !isset($react_setup['status']) || $react_setup['status'] == 0): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong></strong>  <?php echo e(translate('Please_check_if_your_domain_is_register_or_not_at_6amTech_Store')); ?> . <a href="https://store.6amtech.com/customer/auth/login" ><?php echo e(translate('Click_here')); ?></a> <?php echo e(translate('to_login_in_Store')); ?>.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <!-- End Page Header -->
        <div class="card">
            <div class="card-body">
                <form action="<?php echo e(env('APP_MODE')!='demo'?route('admin.business-settings.react-update'):'javascript:'); ?>" method="post"
                      enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="react_license_code" class="form-label text-capitalize"><?php echo e(translate('React license code')); ?></label>
                                <input type="text" placeholder="<?php echo e(translate('React license code')); ?>" class="form-control h--45px" name="react_license_code" id="react_license_code"
                                    value="<?php echo e(env('APP_MODE')!='demo'?(isset($react_setup['react_license_code']) ? $react_setup['react_license_code'] : ''):''); ?>" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="react_domain" class="form-label text-capitalize"><?php echo e(translate('React Domain')); ?></label>
                                <input type="text" id="react_domain" placeholder="<?php echo e(translate('React Domain')); ?>" class="form-control h--45px" name="react_domain"
                                    value="<?php echo e(env('APP_MODE')!='demo'?(isset($react_setup['react_domain']) ? $react_setup['react_domain'] : ''):''); ?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>" class="btn btn--primary mb-2 call-demo"><?php echo e(translate('messages.save')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/business-settings/react-setup.blade.php ENDPATH**/ ?>