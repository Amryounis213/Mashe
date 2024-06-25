<?php $__env->startSection('title',translate('messages.restaurant_view')); ?>
<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="card card-from-sm">
            <div class="card-body">
                <!-- Page Header -->
                <div class="page-header">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <div class="page--header-title">
                            <h1 class="page-header-title"> <?php echo e(translate('Shop_Details')); ?> </h1>
                            <p class="page-header-text">  <?php echo e(translate('Created_at')); ?> <?php echo e(\App\CentralLogics\Helpers::time_date_format($shop->created_at)); ?></p>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="<?php echo e(route('vendor.shop.edit')); ?>" class="btn btn-primary"><i class="tio-open-in-new"></i> <?php echo e(translate('Edit_Shop')); ?> </a>
                        </div>
                    </div>
                </div>
                <!-- End Page Header -->
                <!-- Banner -->
                <section class="shop-details-banner">
                    <div class="card">
                        <div class="card-body px-0 pt-0">
                            <img  class="shop-details-banner-img"
                            src="<?php echo e(\App\CentralLogics\Helpers::onerror_image_helper($shop?->cover_photo, dynamicStorage('storage/app/public/restaurant/cover/'.$shop?->cover_photo), dynamicAsset('public/assets/admin/img/900x400/img1.jpg'), 'restaurant/cover/')); ?>"
                            alt="image">

                            <div class="shop-details-banner-content">
                                <div class="shop-details-banner-content-thumbnail">
                                    <img class="thumbnail"
                                    src="<?php echo e(\App\CentralLogics\Helpers::onerror_image_helper($shop?->logo, dynamicStorage('storage/app/public/restaurant/'.$shop?->logo), dynamicAsset('public/assets/admin/img/160x160/img1.jpg'), 'restaurant/')); ?>"
                                    alt="image">
                                    <h3 class="mt-4 pt-3 mb-4 d-sm-none"><?php echo e($shop->name); ?></h3>
                                </div>
                                <div class="shop-details-banner-content-content">
                                    <h3 class="mt-sm-4 pt-sm-3 mb-4 d-none d-sm-block"><?php echo e($shop->name); ?></h3>
                                    <div class="shop-details-model">
                                        <div class="shop-details-model-item">
                                            <img src="<?php echo e(dynamicAsset('/public/assets/admin/new-img/icon-1.png')); ?>" alt="">
                                            <div class="shop-details-model-item-content">
                                                <h6>  <?php echo e(translate('Business_Model')); ?> </h6>
                                                <?php if($shop->restaurant_model == 'commission'): ?>
                                                    <div><?php echo e(translate('Commission_Base')); ?></div>
                                                <?php elseif($shop->restaurant_model == 'none'): ?>
                                                    <div><?php echo e(translate('Not_chosen')); ?></div>
                                                <?php else: ?>
                                                    <div><?php echo e(translate('Subscription')); ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="shop-details-model-item">
                                            <img src="<?php echo e(dynamicAsset('/public/assets/admin/new-img/icon_6.png')); ?>" alt="">
                                            <div class="shop-details-model-item-content">
                                                <h6>  <?php echo e(translate('admin_Commission')); ?> </h6>
                                                <div> <?php echo e((isset($shop->comission)?$shop->comission:\App\Models\BusinessSetting::where('key','admin_commission')->first()?->value)); ?> %</div>
                                            </div>
                                        </div> <div class="shop-details-model-item">
                                            <img src="<?php echo e(dynamicAsset('/public/assets/admin/new-img/icon-2.png')); ?>" alt="">
                                            <div class="shop-details-model-item-content">
                                                <h6>  <?php echo e(translate('VAT/TAX')); ?> </h6>
                                                <div> <?php echo e($shop->tax); ?> %</div>
                                            </div>
                                        </div>
                                        <div class="shop-details-model-item">
                                            <img src="<?php echo e(dynamicAsset('/public/assets/admin/new-img/icon-3.png')); ?>" alt="">
                                            <div class="shop-details-model-item-content">
                                                <h6><?php echo e(translate('Phone')); ?> </h6>
                                                <div><?php echo e($shop->phone); ?></div>
                                            </div>
                                        </div>
                                        <div class="shop-details-model-item">
                                            <img src="<?php echo e(dynamicAsset('/public/assets/admin/new-img/icon-4.png')); ?>" alt="">
                                            <div class="shop-details-model-item-content">
                                                <h6> <?php echo e(translate('Address')); ?> </h6>
                                                <div><?php echo e($shop->address); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header justify-content-between align-items-center">
                            <label class="input-label text-capitalize d-inline-flex align-items-center m-0">
                                <span class="line--limit-1"><img src="<?php echo e(dynamicAsset('/public/assets/admin/img/company.png')); ?>" alt=""> <b> <?php echo e(translate('Announcement')); ?> </b> </span>
                                <span data-toggle="tooltip" data-placement="right" data-original-title="<?php echo e(translate('This_announcement_shown_in_the_user_app/web')); ?>" class="input-label-secondary">
                                    <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/info-circle.svg')); ?>" alt="info"></span>
                            </label>
                            <label class="toggle-switch toggle-switch-sm m-0">
                                <input type="checkbox"  name="announcement" class="toggle-switch-input update-status" data-url="<?php echo e(route('vendor.business-settings.toggle-settings',[$shop->id,$shop->announcement?0:1, 'announcement'])); ?>" id="announcement" <?php echo e($shop->announcement?'checked':''); ?> >
                                <span class="toggle-switch-label text">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo e(route('vendor.shop.update-message')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <textarea name="announcement_message" id="" maxlength="254" class="form-control h-100px" placeholder="<?php echo e(translate('messages.ex_:_ABC_Company')); ?>"><?php echo e($shop->announcement_message??''); ?></textarea>
                                <div class="mt-3 text-right">
                                    <button type="submit" class="btn btn--primary"><?php echo e(translate('publish')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
                <!-- Banner -->

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('script_2'); ?>
    <script>
        "use strict";
        $('.update-status').on('click', function (){
            let route = $(this).data('url');
            let code = $(this).data('code');
            updateStatus(route, code);
        })

        function updateStatus(route, code) {
            $.get({
                url: route,
                data: {
                    code: code,
                },
                success: function (data) {
                    if (data.error == 403) {
                        toastr.error('<?php echo e(translate('status_can_not_be_updated')); ?>');
                        location.reload();
                    }
                    else{
                        toastr.success('<?php echo e(translate('messages.Restaurant settings updated!')); ?>');
                    }
                }
            });
        }
    </script>
    <!-- Page level plugins -->
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.vendor.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/vendor-views/shop/shopInfo.blade.php ENDPATH**/ ?>