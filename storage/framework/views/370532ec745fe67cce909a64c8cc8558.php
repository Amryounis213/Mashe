<?php $__env->startSection('title', translate('messages.Update_Country')); ?>

<?php $__env->startPush('css_or_js'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h2 class="page-header-title text-capitalize">
                        <div class="card-header-icon d-inline-flex mr-2 img">
                            <img src="<?php echo e(dynamicAsset('public/assets/admin/img/sub-country.png')); ?>" alt="">
                        </div>
                        <span>
                            <?php echo e($country->position ? translate('messages.sub') . ' ' : ''); ?><?php echo e(translate('messages.Country_Update')); ?>

                        </span>
                    </h2>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="card">
            <div class="card-body">
                <form action="<?php echo e(route('admin.country.update', [$country['id']])); ?>" method="post"
                    enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php ($language = \App\Models\BusinessSetting::where('key', 'language')->first()); ?>
                    <?php ($language = $language->value ?? null); ?>
                    <?php ($default_lang = str_replace('_', '-', app()->getLocale())); ?>

                    <div class="row">
                        <div class="col-lg-12">
                            <?php if($language): ?>
                                <ul class="nav nav-tabs mb-4">
                                    <li class="nav-item">
                                        <a class="nav-link lang_link active" href="#"
                                            id="default-link"><?php echo e(translate('Default')); ?></a>
                                    </li>
                                    <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="nav-item">
                                            <a class="nav-link lang_link" href="#"
                                                id="<?php echo e($lang); ?>-link"><?php echo e(\App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')'); ?></a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                                <div class="form-group lang_form" id="default-form">
                                    <label class="input-label"
                                        for="exampleFormControlInput1"><?php echo e(translate('messages.name')); ?></label>
                                    <input type="text" name="name[]" class="form-control"
                                        placeholder="<?php echo e(translate('Ex:_Country_Name')); ?>"
                                        value="<?php echo e($country?->getRawOriginal('name')); ?>" maxlength="191">
                                    <input type="hidden" name="lang[]" value="default">
                                </div>
                                <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                    if (count($country['translations'])) {
                                        $translate = [];
                                        foreach ($country['translations'] as $t) {
                                            if ($t->locale == $lang && $t->key == 'name') {
                                                $translate[$lang]['name'] = $t->value;
                                            }
                                        }
                                    }
                                    ?>
                                    <div class="form-group d-none lang_form" id="<?php echo e($lang); ?>-form">
                                        <label class="input-label"
                                            for="exampleFormControlInput1"><?php echo e(translate('messages.name')); ?>

                                            (<?php echo e(strtoupper($lang)); ?>)</label>
                                        <input id="name" type="text" name="name[]" class="form-control"
                                            placeholder="<?php echo e(translate('messages.new_country')); ?>" maxlength="191"
                                            value="<?php echo e($translate[$lang]['name'] ?? null); ?>">
                                    </div>
                                    <input type="hidden" name="lang[]" value="<?php echo e($lang); ?>">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <div class="form-group lang_form" id="default-form">
                                    <label class="input-label"
                                        for="exampleFormControlInput1"><?php echo e(translate('messages.name')); ?></label>
                                    <input type="text" name="name[]" class="form-control"
                                        placeholder="<?php echo e(translate('Ex:_country_Name')); ?>" value="<?php echo e($country['name']); ?>"
                                        maxlength="191">
                                    <input type="hidden" name="lang[]" value="default">
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="btn--container justify-content-end">
                            <button id="reset_btn" type="button"
                                class="btn btn--reset"><?php echo e(translate('messages.reset')); ?></button>
                            <button type="submit" class="btn btn--primary"><?php echo e(translate('messages.update')); ?></button>
                        </div>
                </form>
            </div>
            <!-- End Table -->
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/js/view-pages/country-index.js"></script>
    <script>
        "use strict";
        $('#reset_btn').click(function() {
            
            
            
            location.reload();
        })

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg1").change(function() {
            readURL(this);
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/country/edit.blade.php ENDPATH**/ ?>