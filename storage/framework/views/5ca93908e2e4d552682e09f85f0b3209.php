<?php $__env->startSection('title', translate('messages.landing_page_settings')); ?>
<?php $__env->startSection('content'); ?>

    <div class="content container-fluid">
        <div class="page-header">
            <div class="d-flex flex-wrap justify-content-between align-items-start">
                <h1 class="page-header-title text-capitalize">
                    <div class="card-header-icon d-inline-flex mr-2 img">
                        <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/landing-page.png')); ?>" class="mw-26px" alt="public">
                    </div>
                    <span>
                        <?php echo e(translate('React_Landing_Page')); ?>

                    </span>
                </h1>
                <div class="text--primary-2 py-1 d-flex flex-wrap align-items-center" type="button" data-toggle="modal" data-target="#how-it-works">
                    <strong class="mr-2"><?php echo e(translate('See_how_it_works')); ?></strong>
                    <div>
                        <i class="tio-info-outined"></i>
                    </div>
                </div>
            </div>
            <div class="js-nav-scroller hs-nav-scroller-horizontal">
                <?php echo $__env->make('admin-views.landing_page.top_menu.react_landing_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>

        <?php ($default_lang = str_replace('_', '-', app()->getLocale())); ?>
        <?php if($language): ?>
            <ul class="nav nav-tabs mb-4 border-0">
                <li class="nav-item">
                    <a class="nav-link lang_link active"
                    href="#"
                    id="default-link"><?php echo e(translate('messages.default')); ?></a>
                </li>
                <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="nav-item">
                        <a class="nav-link lang_link"
                            href="#"
                            id="<?php echo e($lang); ?>-link"><?php echo e(\App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')'); ?></a>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>



        <form action="<?php echo e(route('admin.react_landing_page.settings', 'react-header')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <h5 class="card-title d-flex align-items-center mr-2 mb-2">
                <span class="card-header-icon mr-2">
                    <img src="<?php echo e(dynamicAsset('public/assets/admin/img/react_header.png')); ?>" alt="" class="mw-100">
                </span>
                <span><?php echo e(translate('messages.Header_Section')); ?></span>
            </h5>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6 lang_form default-form">
                            <div class="row g-3">
                                <input type="hidden" name="lang[]" value="default">
                                <div class="col-md-12">
                                    <label for="react_header_title" class="form-label"><?php echo e(translate('Title')); ?> (<?php echo e(translate('messages.default')); ?>)
                                      <span class="input-label-secondary text--title" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="<?php echo e(translate('Write_the_title_within_20_characters')); ?>">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </label>
                                    <input id="react_header_title" maxlength="20" type="text" name="react_header_title[]"  class="form-control" placeholder="<?php echo e(translate('Ex:_John')); ?>"
                                    value="<?php echo e($react_header_title?->getRawOriginal('value') ?? ''); ?>">
                                </div>

                                <div class="col-md-12">
                                    <label for="react_header_sub_title" class="form-label"><?php echo e(translate('messages.Subtitle')); ?> (<?php echo e(translate('messages.default')); ?>)
                                      <span class="input-label-secondary text--title" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="<?php echo e(translate('Write_the_subtitle_within_50_characters')); ?>">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </label>
                                    <input id="react_header_sub_title" maxlength="50" type="text" name="react_header_sub_title[]"  placeholder="<?php echo e(translate('Very_Good_Company')); ?>"  class="form-control"
                                    value="<?php echo e($react_header_sub_title?->getRawOriginal('value') ?? ''); ?>">
                                </div>
                            </div>
                        </div>

                        <?php if($language): ?>
                        <?php $__empty_1 = true; $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-md-6 d-none lang_form" id="<?php echo e($lang); ?>-form1">

                            <?php
                            if($react_header_title?->translations){
                                    $react_header_title_translate = [];
                                    foreach($react_header_title->translations as $t)
                                    {
                                        if($t->locale == $lang && $t->key=='react_header_title'){
                                            $react_header_title_translate[$lang]['value'] = $t->value;
                                        }
                                    }
                                }
                            if($react_header_sub_title?->translations){
                                    $react_header_sub_title_translate = [];
                                    foreach($react_header_sub_title->translations as $t)
                                    {
                                        if($t->locale == $lang && $t->key=='react_header_sub_title'){
                                            $react_header_sub_title_translate[$lang]['value'] = $t->value;
                                        }
                                    }
                                }

                                ?>
                            <div class="row g-3">
                                <input type="hidden" name="lang[]" value="<?php echo e($lang); ?>">
                                <div class="col-md-12">
                                    <label for="react_header_title<?php echo e($lang); ?>" class="form-label"><?php echo e(translate('Title')); ?> (<?php echo e(strtoupper($lang)); ?>)
                                      <span class="input-label-secondary text--title" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="<?php echo e(translate('Write_the_title_within_20_characters')); ?>">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </label>
                                    <input id="react_header_title<?php echo e($lang); ?>" maxlength="20" type="text" name="react_header_title[]" class="form-control" placeholder="<?php echo e(translate('Ex:_John')); ?>" value="<?php echo e($react_header_title_translate[$lang]['value'] ?? ''); ?>">
                                </div>

                                <div class="col-md-12">
                                    <label for="react_header_sub_title<?php echo e($lang); ?>" class="form-label"><?php echo e(translate('messages.Subtitle')); ?> (<?php echo e(strtoupper($lang)); ?>)
                                      <span class="input-label-secondary text--title" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="<?php echo e(translate('Write_the_subtitle_within_50_characters')); ?>">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </label>
                                    <input id="react_header_sub_title<?php echo e($lang); ?>" type="text" maxlength="50"  name="react_header_sub_title[]" placeholder="<?php echo e(translate('Very_Good_Company')); ?>"  class="form-control"
                                    value="<?php echo e($react_header_sub_title_translate[$lang]['value'] ?? ''); ?>">

                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php endif; ?>
                        <?php endif; ?>


                        <div class="col-sm-6">
                            <div class="ml-xl-5 pl-xxl-4">
                                <label class="form-label d-block mb-2">
                                    <?php echo e(translate('messages.Section_Background_Image')); ?>  <span class="text--primary"><?php echo e(translate('(4:1)')); ?></span>
                                </label>
                                <div class="d-inline-block position-relative">

                                <label class="upload-img-3 m-0 d-block">
                                    <div class="img">
                                        <img  src="<?php echo e(\App\CentralLogics\Helpers::onerror_image_helper(
                                    $react_header_image?->value,
                                    dynamicStorage('storage/app/public/react_header').'/'.$react_header_image?->value,
                                    dynamicAsset('/public/assets/admin/img/upload-3.png'),
                                    'react_header/'
                                )); ?>"
                                          data-onerror-image="<?php echo e(dynamicAsset('/public/assets/admin/img/upload-3.png')); ?>"
                                          class="vertical-img max-w-187px onerror-image" alt="">
                                    </div>
                                        <input type="file" name="react_header_image" hidden>
                                </label>
                                <?php if($react_header_image?->value): ?>
                                <span id="remove_image_1"
                                      class="remove_image_button remove-image"
                                      data-id="remove_image_1"
                                      data-title="<?php echo e(translate('Warning!')); ?>"
                                      data-text="<p><?php echo e(translate('Are_you_sure_you_want_to_remove_this_image_?')); ?></p>"
                                    > <i class="tio-clear"></i></span>
                                <?php endif; ?>
                            </div>
                            </div>
                        </div>

                    </div>
                    <div class="btn--container justify-content-end mt-3">
                        <button type="reset" class="btn btn--reset"><?php echo e(translate('Reset')); ?></button>
                        <button type="submit"   class="btn btn--primary mb-2"><?php echo e(translate('Save')); ?></button>
                    </div>
                </div>
            </div>
        </form>



    <form  id="remove_image_1_form" action="<?php echo e(route('admin.remove_image')); ?>" method="post">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="id" value="<?php echo e($react_header_image?->id); ?>" >
        <input type="hidden" name="model_name" value="DataSetting" >
        <input type="hidden" name="image_path" value="react_header" >
        <input type="hidden" name="field_name" value="value" >
    </form>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/landing_page/react/header.blade.php ENDPATH**/ ?>