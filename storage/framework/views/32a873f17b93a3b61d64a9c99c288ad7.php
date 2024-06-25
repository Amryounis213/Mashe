<?php $__env->startSection('title',translate('messages.app_&_web_settings')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header d-flex flex-wrap align-items-center justify-content-between">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="<?php echo e(dynamicAsset('public/assets/admin/img/app.png')); ?>" class="w--26" alt="">
                </span>
                <span>
                    <?php echo e(translate('messages.app_&_web_settings')); ?>

                </span>
            </h1>
            <div class="text--primary-2 d-flex flex-wrap align-items-center" type="button" data-toggle="modal" data-target="#how-it-works">
                <strong class="mr-2"><?php echo e(translate('See_how_it_works!')); ?></strong>
                  <div class="blinkings">
                    <i class="tio-info-outined"></i>
                </div>
            </div>
        </div>
        <!-- End Page Header -->

        <?php
             $key = [
            'app_minimum_version_android_restaurant','app_minimum_version_android','app_url_android',
            'app_url_android_restaurant','app_minimum_version_ios_restaurant','app_url_ios_restaurant','app_minimum_version_android_deliveryman','tax_included','order_subscription','app_minimum_version_ios',
            'app_url_android_deliveryman','app_url_ios','popular_food','popular_restaurant','new_restaurant',
            'most_reviewed_foods','app_minimum_version_ios_deliveryman','app_url_ios_deliveryman'
        ];
        $settings = \App\Models\BusinessSetting::whereIn('key', $key)->pluck('value','key')->toArray();
        $app_minimum_version_android=$settings['app_minimum_version_android'] ?? null;
        $app_url_android=$settings['app_url_android']?? null;
        $app_minimum_version_ios=$settings['app_minimum_version_ios'] ?? null;
        $app_url_ios=$settings['app_url_ios'] ?? null;
        $popular_food=$settings['popular_food'] ?? null;
        $popular_restaurant=$settings['popular_restaurant'] ?? null;
        $new_restaurant=$settings['new_restaurant'] ?? null;
        $most_reviewed_foods=$settings['most_reviewed_foods'] ?? null;
        $app_minimum_version_android_restaurant=$settings['app_minimum_version_android_restaurant'] ?? null;
        $app_url_android_restaurant= $settings['app_url_android_restaurant'] ?? null;
        $app_minimum_version_ios_restaurant=$settings['app_minimum_version_ios_restaurant'] ?? null;
        $app_url_ios_restaurant=$settings['app_url_ios_restaurant'] ?? null;
        $app_minimum_version_android_deliveryman=$settings['app_minimum_version_android_deliveryman'] ?? null;
        $app_url_android_deliveryman=$settings['app_url_android_deliveryman'] ?? null;
        $app_url_ios_deliveryman=$settings['app_url_ios_deliveryman'] ?? null;
        $app_minimum_version_ios_deliveryman=$settings['app_minimum_version_ios_deliveryman'] ?? null;
        ?>

        <div class="card mb-3">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group m-0">
                            <form action="<?php echo e(route('admin.business-settings.toggle-settings',['popular_food',$popular_food?0:1, 'popular_food'])); ?>" id="popular_food_form" method="get">
                            <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border rounded px-3 px-xl-4 form-control" >
                                <span class="pr-2"><?php echo e(translate('messages.popular_foods')); ?>

                                      <span class="input-label-secondary text--title" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="<?php echo e(translate('If_enabled,_Popular_Foods_will_be_available_on_the_User_App')); ?>">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </span>
                                <input type="checkbox"
                                       data-id="popular_food"
                                       data-type="status"
                                       data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/veg-on.png')); ?>"
                                       data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/veg-off.png')); ?>"
                                       data-title-on="<?php echo e(translate('Want_to_enable_the_Popular_Foods_section!')); ?>"
                                       data-title-off="<?php echo e(translate('Want_to_disable_the_Popular_Foods_option?')); ?>"
                                       data-text-on="<p><?php echo e(translate('If_enabled,_users_can_see_popular_foods_on_the_user_app.')); ?></p>"
                                       data-text-off="<p><?php echo e(translate('If_disabled,_users_can_not_see_popular_foods_on_the_user_app.')); ?></p>"
                                       class="status toggle-switch-input dynamic-checkbox"

                                id="popular_food" <?php echo e($popular_food?'checked':''); ?>>
                                <span class="toggle-switch-label">
                                    <span class="toggle-switch-indicator"></span>
                                </span>

                            </label>
                        </form>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group m-0">
                            <form action="<?php echo e(route('admin.business-settings.toggle-settings',['popular_restaurant',$popular_restaurant?0:1, 'popular_restaurant'])); ?>" id="popular_restaurant_form" method="get">
                            <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border rounded px-3 px-xl-4 form-control" >
                                <span class="pr-2"><?php echo e(translate('messages.popular_restaurants')); ?>

                                      <span class="input-label-secondary text--title" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="<?php echo e(translate('If_enabled,_the_Popular_Restaurants_section_will_be_available_on_the_User_App')); ?>">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </span>
                                <input type="checkbox" name="popular_restaurant"
                                       data-id="popular_restaurant"
                                       data-type="status"
                                       data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/store-self-reg-on.png')); ?>"
                                       data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/store-self-reg-off.png')); ?>"
                                       data-title-on="<?php echo e(translate('Want_to_enable_the_Popular_Restaurants_section')); ?>"
                                       data-title-off="<?php echo e(translate('Want_to_disable_the_Popular_Restaurants_section?!')); ?>"
                                       data-text-on="<p><?php echo e(translate('If_enabled,_users_can_see_popular_restaurants_section_on_the_user_app.')); ?></p>"
                                       data-text-off="<p><?php echo e(translate('If_disabled,_users_can_not_see_popular_restaurants_section_on_the_user_app.')); ?></p>"
                                       class="status toggle-switch-input dynamic-checkbox"

                                       id="popular_restaurant" <?php echo e($popular_restaurant?'checked':''); ?>>
                                <span class="toggle-switch-label">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </form>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group m-0">
                            <form action="<?php echo e(route('admin.business-settings.toggle-settings',['new_restaurant',$new_restaurant?0:1, 'new_restaurant'])); ?>" id="new_restaurant_form" method="get">
                            <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border rounded px-3 px-xl-4 form-control" >
                                <span class="pr-2 text-capitalize"><?php echo e(translate('messages.new_restaurants')); ?>

                                      <span class="input-label-secondary text--title" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="<?php echo e(translate('If_enabled,_the_New_Restaurants_will_be_available_on_the_User_App.')); ?>">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </span>
                                <input type="checkbox"
                                 id="new_restaurant"
                                       data-id="new_restaurant"
                                       data-type="status"
                                       data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/store-self-reg-on.png')); ?>"
                                       data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/store-self-reg-off.png')); ?>"
                                       data-title-on="<?php echo e(translate('Want_to_enable_the_New_Restaurants_section')); ?>"
                                       data-title-off="<?php echo e(translate('Want_to_disable_the_New_Restaurants_section!')); ?>"
                                       data-text-on="<p><?php echo e(translate('If_enabled,_users_can_see_new_restaurants_section_on_the_user_app.')); ?></p>"
                                       data-text-off="<p><?php echo e(translate('If_disabled,_users_can_not_see_new_restaurants_section_on_the_user_app.')); ?></p>"
                                       class="status toggle-switch-input dynamic-checkbox"

                                    <?php echo e($new_restaurant?'checked':''); ?>>
                                <span class="toggle-switch-label">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </form>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-12">
                        <div class="form-group m-0">
                            <form action="<?php echo e(route('admin.business-settings.toggle-settings',['most_reviewed_foods',$most_reviewed_foods?0:1, 'most_reviewed_foods'])); ?>" id="most_reviewed_foods_form" method="get">
                            <label class="toggle-switch toggle-switch-sm d-flex justify-content-between border rounded px-3 px-xl-4 form-control" >
                                <span class="pr-2 text-capitalize"><?php echo e(translate('messages.most_reviewed_foods')); ?>

                                      <span class="input-label-secondary text--title" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="<?php echo e(translate('If_enabled,_the_Most_Reviewed_Foods_will_be_available_on_the_User_App.')); ?>">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </span>
                                <input type="checkbox"   id="most_reviewed_foods"
                                        data-id="most_reviewed_foods"
                                        data-type="status"
                                        data-image-on="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/veg-on.png')); ?>"
                                        data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal/veg-off.png')); ?>"
                                        data-title-on="<?php echo e(translate('Want_to_enable_the_Most_Reviewed_Foods_option?!')); ?>"
                                        data-title-off="<?php echo e(translate('Want_to_disable_the_Most_Reviewed_Foods_option?!')); ?>"
                                        data-text-on="<p><?php echo e(translate('If_enabled,_users_can_see_the_most_reviewed_foods_on_the_user_app.')); ?></p>"
                                        data-text-off="<p><?php echo e(translate('If_disabled,_users_can_not_see_the_most_reviewed_foods_on_the_user_app.')); ?></p>"
                                        class="toggle-switch-input dynamic-checkbox"

                                <?php echo e($most_reviewed_foods?'checked':''); ?>>
                                <span class="toggle-switch-label">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <form action="<?php echo e(route('admin.business-settings.app-settings')); ?>" method="post"
        enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
            <h5 class="card-title mb-3 pt-3">
                <span class="card-header-icon mr-2"><i class="tio-settings-outlined"></i></span> <span><?php echo e(translate('User_App_Version_Control')); ?></span>
            </h5>
            <input type="hidden" name="type" value="user_app" >
            <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <h5 class="card-title mb-3">
                                <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/andriod.png')); ?>" class="mr-2" alt="">
                                <?php echo e(translate('For_android')); ?>

                            </h5>
                            <div class="__bg-F8F9FC-card">
                                <div class="form-group">
                                    <label  for="app_minimum_version_android" class="form-label">
                                        <?php echo e(translate('messages.Minimum_User_App_Version_for_Force_Update')); ?> (<?php echo e(translate('messages.android')); ?>)
                                        <span class="input-label-secondary text--title" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="<?php echo e(translate('The_minimum_user_app_version_required_for_the_app_functionality')); ?>">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </label>
                                    <input type="number" id="app_minimum_version_android" placeholder="<?php echo e(translate('messages.app_minimum_version')); ?>" class="form-control h--45px" name="app_minimum_version_android"
                                        step="0.001"   min="0" value="<?php echo e(env('APP_MODE')!='demo'?$app_minimum_version_android??'':''); ?>">
                                </div>
                                <div class="form-group mb-md-0">
                                    <label for="app_url_android" class="form-label">
                                        <?php echo e(translate('messages.Download_URL_for_User_App')); ?> (<?php echo e(translate('messages.android')); ?>)
                                        <span class="input-label-secondary text--title" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="<?php echo e(translate('Users_will_download_the_latest_user_app_version_using_this_URL')); ?>">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </label>
                                    <input type="text" id="app_url_android" placeholder="<?php echo e(translate('messages.Download_Url')); ?>" class="form-control h--45px" name="app_url_android"
                                        value="<?php echo e(env('APP_MODE')!='demo'?$app_url_android??'':''); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="card-title mb-3">
                                <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/apple.png')); ?>" class="mr-2" alt="">
                                <?php echo e(translate('For_iOS')); ?>

                            </h5>
                            <div class="__bg-F8F9FC-card">
                                <div class="form-group">
                                    <label for="$app_minimum_version_ios"  class="form-label"><?php echo e(translate('messages.Minimum_User_App_Version_for_Force_Update')); ?> (<?php echo e(translate('messages.ios')); ?>)
                                        <span class="input-label-secondary text--title" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="<?php echo e(translate('The_minimum_user_app_version_required_for_the_app_functionality')); ?>">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </label>
                                    <input type="number" id="$app_minimum_version_ios" placeholder="<?php echo e(translate('messages.app_minimum_version')); ?>"  class="form-control h--45px" name="app_minimum_version_ios"
                                    step="0.001"  min="0" value="<?php echo e(env('APP_MODE')!='demo'?$app_minimum_version_ios??'':''); ?>">
                                </div>
                                <div class="form-group mb-md-0">
                                    <label for="app_url_ios" class="form-label">
                                        <?php echo e(translate('messages.Download_URL_for_User_App')); ?> (<?php echo e(translate('messages.ios')); ?>)
                                        <span class="input-label-secondary text--title" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="<?php echo e(translate('Users_will_download_the_latest_user_app_version_using_this_URL')); ?>">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </label>
                                    <input type="text" id="app_url_ios" placeholder="<?php echo e(translate('messages.Download_Url')); ?>" class="form-control h--45px" name="app_url_ios"
                                    value="<?php echo e(env('APP_MODE')!='demo'?$app_url_ios??'':''); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn--container justify-content-end mt-3">
                        <button type="reset" class="btn btn--reset"><?php echo e(translate('messages.reset')); ?></button>
                        <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>" class="btn btn--primary mb-2 call-demo"><?php echo e(translate('messages.submit')); ?></button>
                    </div>
                </div>
            </div>
        </form>


        <form action="<?php echo e(route('admin.business-settings.app-settings')); ?>" method="post"
        enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
            <h5 class="card-title mb-3 pt-4">
                <span class="card-header-icon mr-2"><i class="tio-settings-outlined"></i></span> <span><?php echo e(translate('Restaurant_App_Version_Control')); ?></span>
            </h5>
            <input type="hidden" name="type" value="restaurant_app" >
            <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <h5 class="card-title mb-3">
                                <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/andriod.png')); ?>" class="mr-2" alt="">
                                <?php echo e(translate('For_android')); ?>

                            </h5>
                            <div class="__bg-F8F9FC-card">
                                <div class="form-group">
                                    <label for="app_minimum_version_android_restaurant"  class="form-label text-capitalize"><?php echo e(translate('messages.Minimum_Restaurant_App_Version_for_Force_Update')); ?> (<?php echo e(translate('messages.android')); ?>)
                                        <span class="input-label-secondary text--title" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="<?php echo e(translate('messages.The_minimum_Restaurant_app_version_required_for_the_app_functionality.')); ?>">
                                        <i class="tio-info-outined"></i>
                                    </span>
                                    </label>
                                    <input type="number" id="app_minimum_version_android_restaurant" placeholder="<?php echo e(translate('messages.app_minimum_version')); ?>" class="form-control h--45px" name="app_minimum_version_android_restaurant"
                                        step="0.001"   min="0" value="<?php echo e(env('APP_MODE')!='demo'?$app_minimum_version_android_restaurant??'':''); ?>">
                                </div>
                                <div class="form-group mb-md-0">
                                    <label  for="app_url_android_restaurant" class="form-label text-capitalize">
                                        <?php echo e(translate('messages.Download_URL_for_Restaurant_App')); ?> (<?php echo e(translate('messages.android')); ?>)
                                        <span class="input-label-secondary text--title" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="<?php echo e(translate('Users_will_download_the_latest_Restaurant_app_using_this_URL')); ?>">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </label>
                                    <input type="text" id="app_url_android_restaurant" placeholder="<?php echo e(translate('messages.Download_Url')); ?>" class="form-control h--45px" name="app_url_android_restaurant"
                                        value="<?php echo e(env('APP_MODE')!='demo'?$app_url_android_restaurant??'':''); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="card-title mb-3">
                                <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/apple.png')); ?>" class="mr-2" alt="">
                                <?php echo e(translate('For_iOS')); ?>

                            </h5>
                            <div class="__bg-F8F9FC-card">
                                <div class="form-group">
                                    <label for="app_minimum_version_ios_restaurant"  class="form-label text-capitalize"><?php echo e(translate('messages.Minimum_Restaurant_App_Version_for_Force_Update')); ?> (<?php echo e(translate('messages.ios')); ?>)
                                        <span class="input-label-secondary text--title" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="<?php echo e(translate('messages.The_minimum_Restaurant_app_version_required_for_the_app_functionality.')); ?>">
                                        <i class="tio-info-outined"></i>
                                    </span>
                                    </label>
                                    <input type="number" id="app_minimum_version_ios_restaurant" placeholder="<?php echo e(translate('messages.app_minimum_version')); ?>" class="form-control h--45px" name="app_minimum_version_ios_restaurant"
                                    step="0.001"  min="0" value="<?php echo e(env('APP_MODE')!='demo'?$app_minimum_version_ios_restaurant??'':''); ?>">
                                </div>
                                <div class="form-group mb-md-0">
                                    <label for="app_url_ios_restaurant" class="form-label text-capitalize">
                                        <?php echo e(translate('messages.Download_URL_for_Restaurant_App')); ?> (<?php echo e(translate('messages.ios')); ?>)
                                        <span class="input-label-secondary text--title" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="<?php echo e(translate('Users_will_download_the_latest_Restaurant_app_version_using_this_URL')); ?>">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </label>
                                    <input type="text" id="app_url_ios_restaurant" placeholder="<?php echo e(translate('messages.Download_Url')); ?>" class="form-control h--45px" name="app_url_ios_restaurant"
                                    value="<?php echo e(env('APP_MODE')!='demo'?$app_url_ios_restaurant??'':''); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn--container justify-content-end mt-3">
                        <button type="reset" class="btn btn--reset"><?php echo e(translate('messages.reset')); ?></button>
                        <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"  class="btn btn--primary mb-2 call-demo"><?php echo e(translate('messages.submit')); ?></button>
                    </div>
                </div>
            </div>
        </form>


        <form action="<?php echo e(route('admin.business-settings.app-settings')); ?>" method="post"
        enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
            <h5 class="card-title mb-3 pt-4">
                <span class="card-header-icon mr-2"><i class="tio-settings-outlined"></i></span> <span><?php echo e(translate('Deliveryman_App_Version_Control')); ?></span>
            </h5>
            <input type="hidden" name="type" value="delivery_app" >

            <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <h5 class="card-title mb-3">
                                <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/andriod.png')); ?>" class="mr-2" alt="">
                                <?php echo e(translate('For_android')); ?>

                            </h5>
                            <div class="__bg-F8F9FC-card">
                                <div class="form-group">
                                    <label for="app_minimum_version_android_deliveryman"  class="form-label text-capitalize"><?php echo e(translate('messages.Minimum_Deliveryman_App_Version_for_Force_Update')); ?> (<?php echo e(translate('messages.android')); ?>)
                                        <span class="input-label-secondary text--title" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="<?php echo e(translate('messages.The_minimum_Deliveryman_app_version_required_for_the_app_functionality')); ?>">
                                        <i class="tio-info-outined"></i>
                                    </span>
                                    </label>
                                    <input type="number" id="app_minimum_version_android_deliveryman" placeholder="<?php echo e(translate('messages.app_minimum_version')); ?>" class="form-control h--45px" name="app_minimum_version_android_deliveryman"
                                        step="0.001"   min="0" value="<?php echo e(env('APP_MODE')!='demo'?$app_minimum_version_android_deliveryman??'':''); ?>">
                                </div>
                                <div class="form-group mb-md-0">
                                    <label for="app_url_android_deliveryman" class="form-label text-capitalize">
                                        <?php echo e(translate('messages.Download_URL_for_Deliveryman_App')); ?> (<?php echo e(translate('messages.android')); ?>)
                                        <span class="input-label-secondary text--title" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="<?php echo e(translate('Users_will_download_the_latest_Deliveryman_app_using_this_URL')); ?>">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </label>
                                    <input type="text" id="app_url_android_deliveryman" placeholder="<?php echo e(translate('messages.Download_Url')); ?>" class="form-control h--45px" name="app_url_android_deliveryman"
                                    value="<?php echo e(env('APP_MODE')!='demo'?$app_url_android_deliveryman??'':''); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="card-title mb-3">
                                <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/apple.png')); ?>" class="mr-2" alt="">
                                <?php echo e(translate('For_iOS')); ?>

                            </h5>
                            <div class="__bg-F8F9FC-card">
                                <div class="form-group">
                                    <label for="app_minimum_version_ios_deliveryman"  class="form-label text-capitalize"><?php echo e(translate('messages.Minimum_Deliveryman_App_Version_for_Force_Update')); ?> (<?php echo e(translate('messages.ios')); ?>)
                                        <span class="input-label-secondary text--title" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="<?php echo e(translate('messages.The_minimum_Deliveryman_app_version_required_for_the_app_functionality')); ?>">
                                        <i class="tio-info-outined"></i>
                                    </span>
                                    </label>
                                    <input type="number" id="app_minimum_version_ios_deliveryman" placeholder="<?php echo e(translate('messages.app_minimum_version')); ?>" class="form-control h--45px" name="app_minimum_version_ios_deliveryman"
                                    step="0.001"  min="0" value="<?php echo e(env('APP_MODE')!='demo'?$app_minimum_version_ios_deliveryman??'':''); ?>">
                                </div>
                                <div class="form-group mb-md-0">
                                    <label for="app_url_ios_deliveryman" class="form-label text-capitalize">
                                        <?php echo e(translate('messages.Download_URL_for_Deliveryman_App')); ?> (<?php echo e(translate('messages.ios')); ?>)
                                        <span class="input-label-secondary text--title" data-toggle="tooltip"
                                        data-placement="right"
                                        data-original-title="<?php echo e(translate('Users_will_download_the_latest_Deliveryman_app_version_using_this_URL')); ?>">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                    </label>
                                    <input type="text" id="app_url_ios_deliveryman" placeholder="<?php echo e(translate('messages.Download_Url')); ?>" class="form-control h--45px" name="app_url_ios_deliveryman"
                                    value="<?php echo e(env('APP_MODE')!='demo'?$app_url_ios_deliveryman??'':''); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn--container justify-content-end mt-3">
                        <button type="reset" class="btn btn--reset"><?php echo e(translate('messages.reset')); ?></button>
                        <button type="<?php echo e(env('APP_MODE')!='demo'?'submit':'button'); ?>"  class="btn btn--primary mb-2 call-demo"><?php echo e(translate('messages.submit')); ?></button>
                    </div>
                </div>
            </div>
        </form>

    </div>

    <div class="modal fade" id="how-it-works">
        <div class="modal-dialog status-warning-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true" class="tio-clear"></span>
                    </button>
                </div>
                <div class="modal-body pb-5 pt-0">
                    <div class="single-item-slider owl-carousel">
                        <div class="item">
                            <div class="mb-20">
                                <div class="text-center">
                                    <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/app.png')); ?>" alt="" class="mb-20">
                                    <h5 class="modal-title"><?php echo e(translate('What is App Version ?')); ?></h5>
                                </div>
                                <ul>
                                    <li>
                                        <?php echo e(translate('This_app_version_defines_the_Restaurant,_Deliveryman,_and_User_app_version_of_StackFood.')); ?>

                                    </li>
                                    <li>
                                        <?php echo e(translate('It_doesn’t_represent_the_Play_Store_or_App_Store_version')); ?>

                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="item">
                            <div class="mb-20">
                                <div class="text-center">
                                    <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/app.png')); ?>" alt="" class="mb-20">
                                    <h5 class="modal-title"><?php echo e(translate('App Download Link')); ?></h5>
                                </div>
                                <ul>
                                    <li>
                                        <?php echo e(translate('The_app_download_link_is_the_URL_from_which_users_can_update_the_app_by_clicking_the_Update_App_button_from_their_app')); ?>

                                    </li>
                                </ul>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/business-settings/app-settings.blade.php ENDPATH**/ ?>