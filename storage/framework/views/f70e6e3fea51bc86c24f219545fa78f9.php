

<?php $__env->startSection('title', translate('Add_New_menu')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link href="<?php echo e(dynamicAsset('public/assets/admin/css/tags-input.min.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i class="tio-add-circle-outlined"></i> <?php echo e(translate('messages.add_new_menu')); ?></h1>
                </div>
            </div>
        </div>

        <!-- End Page Header -->
        <form action="<?php echo e(route('admin.restaurant.add_new_category')); ?>" method="post" id="menu_form" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row g-2">
                <div class="col-lg-6">
                    <div class="card shadow--card-2 border-0">
                        <div class="card-body pb-0">
                            <?php ($language = \App\Models\BusinessSetting::where('key', 'language')->first()); ?>
                            <?php ($language = $language->value ?? null); ?>
                            <?php ($default_lang = str_replace('_', '-', app()->getLocale())); ?>
                                <?php if($language): ?>
                                    <ul class="nav nav-tabs mb-4">
                                        <li class="nav-item">
                                            <a class="nav-link lang_link active"
                                                href="#"
                                                id="default-link"><?php echo e(translate('Default')); ?></a>
                                        </li>
                                        <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="nav-item">
                                                <a class="nav-link lang_link "
                                                    href="#"
                                                    id="<?php echo e($lang); ?>-link"><?php echo e(\App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')'); ?></a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                <?php endif; ?>
                        </div>
                        <?php if($language): ?>
                            <div class="card-body">

                                <div class="lang_form"
                                id="default-form">


                                <div class="form-group">
                                    <label class="input-label"
                                        for="default_name"><?php echo e(translate('messages.name')); ?>

                                        (<?php echo e(translate('Default')); ?>) <span class="form-label-secondary text-danger"
                                        data-toggle="tooltip" data-placement="right"
                                        data-original-title="<?php echo e(translate('messages.Required.')); ?>"> *
                                        </span>
                                    </label>
                                    <input type="text" name="name[]" id="default_name"
                                        class="form-control"
                                        placeholder="<?php echo e(translate('messages.new_menu')); ?>"

                                         >
                                </div>
                                <input type="hidden" name="lang[]" value="default">
                                <div class="form-group mb-0">
                                    <label class="input-label"
                                        for="exampleFormControlInput1"><?php echo e(translate('messages.short_description')); ?>

                                        (<?php echo e(translate('Default')); ?>) <span class="form-label-secondary text-danger"
                                        data-toggle="tooltip" data-placement="right"
                                        data-original-title="<?php echo e(translate('messages.Required.')); ?>"> *
                                        </span></label>
                                    <textarea type="text" name="description[]" class="form-control ckeditor min-height-154px"></textarea>
                                </div>
                            </div>

                                <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="d-none lang_form"
                                id="<?php echo e($lang); ?>-form">
                                        <div class="form-group">
                                            <label class="input-label"
                                                for="<?php echo e($lang); ?>_name"><?php echo e(translate('messages.name')); ?>

                                                (<?php echo e(strtoupper($lang)); ?>)
                                            </label>
                                            <input type="text" name="name[]" id="<?php echo e($lang); ?>_name"
                                                class="form-control"
                                                placeholder="<?php echo e(translate('messages.new_menu')); ?>"
                                                 >
                                        </div>
                                        <input type="hidden" name="lang[]" value="<?php echo e($lang); ?>">
                                        <div class="form-group mb-0">
                                            <label class="input-label"
                                                for="exampleFormControlInput1"><?php echo e(translate('messages.short_description')); ?>

                                                (<?php echo e(strtoupper($lang)); ?>)</label>
                                            <textarea type="text" name="description[]" class="form-control ckeditor min-height-154px"></textarea>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php else: ?>
                            <div class="card-body">
                                <div id="default-form">
                                    <div class="form-group">
                                        <label class="input-label"
                                            for="exampleFormControlInput1"><?php echo e(translate('messages.name')); ?>

                                            (<?php echo e(translate('Default')); ?>)</label>
                                        <input type="text" name="name[]" class="form-control"
                                            placeholder="<?php echo e(translate('messages.new_category')); ?>" >
                                    </div>
                                    <input type="hidden" name="lang[]" value="default">
                                    <div class="form-group mb-0">
                                        <label class="input-label"
                                            for="exampleFormControlInput1"><?php echo e(translate('messages.short_description')); ?></label>
                                        <textarea type="text" name="description[]" class="form-control ckeditor min-height-154px"></textarea>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card shadow--card-2 border-0 h-100">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center gap-3">
                                <p class="mb-0"><?php echo e(translate('menu_Image')); ?></p>

                                <div class="image-box">
                                    <label for="image-input" class="d-flex flex-column align-items-center justify-content-center h-100 cursor-pointer gap-2">
                                    <img width="30" class="upload-icon" src="<?php echo e(asset('public/assets/admin/img/upload-icon.png')); ?>" alt="Upload Icon">
                                    <span class="upload-text"><?php echo e(translate('Upload Image')); ?></span>
                                    <img src="#" alt="Preview Image" class="preview-image">
                                    </label>
                                    <button type="button" class="delete_image">
                                    <i class="tio-delete"></i>
                                    </button>
                                    <input type="file" id="image-input" name="image" accept="image/*" hidden>
                                </div>

                                <p class="opacity-75 max-w220 mx-auto text-center">
                                    <?php echo e(translate('Image format - jpg png jpeg gif Image Size -maximum size 2 MB Image Ratio - 1:1')); ?>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <input hidden name="restaurant_id" value="<?php echo e($restaurant_id); ?>" />
                <div class="col-lg-12">
                    <div class="btn--container justify-content-end">
                        <button type="reset" id="reset_btn"
                            class="btn btn--reset"><?php echo e(translate('messages.reset')); ?></button>
                        <button type="submit"
                            class="btn btn--primary"><?php echo e(translate('messages.submit')); ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/js/tags-input.min.js"></script>
    <script src="<?php echo e(dynamicAsset('public/assets/admin/js/spartan-multi-image-picker.js')); ?>"></script>
    <script src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/js/view-pages/product-index.js"></script>
  
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/vendor/view/add-new-menu.blade.php ENDPATH**/ ?>