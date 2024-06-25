<?php $__env->startSection('title', translate('messages.restaurant_registration')); ?>
<?php $__env->startPush('css_or_js'); ?>
    <link rel="stylesheet" href="<?php echo e(dynamicAsset('public/assets/landing')); ?>/css/style.css" />
    <link href="<?php echo e(dynamicAsset('public/assets/admin/css/tags-input.min.css')); ?>" rel="stylesheet">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
        <!-- Page Header Gap -->
        <div class="h-148px"></div>
        <!-- Page Header Gap -->

    <section class="m-0 landing-inline-1 section-gap">
        <div class="container">
            <!-- Page Header -->
            <div class="step__header">
                <h4 class="title"> <?php echo e(translate('messages.Restaurant_registration_application')); ?></h4>
                <div class="step__wrapper">
                    <div class="step__item current">
                        <span class="shapes"></span>
                        <?php echo e(translate('General Information')); ?>

                    </div>
                    <div class="step__item">
                        <span class="shapes"></span>
                        <?php echo e(translate('Business Plan')); ?>

                    </div>
                    <div class="step__item">
                        <span class="shapes"></span>
                        <?php echo e(translate('Complete')); ?>

                    </div>
                </div>
            </div>
            <!-- End Page Header -->
            <?php ($language=\App\Models\BusinessSetting::where('key','language')->first()); ?>
            <?php ($language = $language->value ?? null); ?>
            <?php ($default_lang = str_replace('_', '-', app()->getLocale())); ?>

            <div class="card __card">
                <div class="card-header py-3 bg-transparent">
                    <h5 class="card-title my-1 text--primary">
                        <span class="card-header-icon">
                            <i class="fa-solid fa-store"></i>
                        </span>
                        <?php echo e(translate('messages.restaurant_info')); ?></h5>
                </div>
                <form class="card-body" action="<?php echo e(route('restaurant.store')); ?>" method="post" enctype="multipart/form-data"
                    class="js-validate">
                    <?php echo csrf_field(); ?>
                    <div class="row g-4">
                        <?php if($language): ?>
                            <ul class="nav nav-tabs mb-4">
                                <li class="nav-item">
                                    <a class="nav-link lang_link active"
                                    href="#"
                                    id="default-link"><?php echo e(translate('Default')); ?></a>
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
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <?php if($language): ?>
                            <div class="form-group mb-0 lang_form" id="default-form">
                                <label class="form-label" for="exampleFormControlInput1"><?php echo e(translate('messages.restaurant_name')); ?> (<?php echo e(translate('messages.default')); ?>)</label>
                                <input type="text" name="name[]" class="form-control"  placeholder="<?php echo e(translate('messages.Ex :_ABC Company')); ?>" maxlength="191"   >
                            </div>
                            <input type="hidden" name="lang[]" value="default">
                                <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-group  mb-0 d-none lang_form" id="<?php echo e($lang); ?>-form">
                                        <label class="form-label" for="exampleFormControlInput1"><?php echo e(translate('messages.restaurant_name')); ?> (<?php echo e(strtoupper($lang)); ?>)</label>
                                        <input type="text" name="name[]" class="form-control"  placeholder="<?php echo e(translate('messages.Ex :_ABC Company')); ?>" maxlength="191"  >
                                    </div>
                                    <input type="hidden" name="lang[]" value="<?php echo e($lang); ?>">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <div class="form-group mb-0">
                                    <label class="form-label" for="exampleFormControlInput1"><?php echo e(translate('messages.restaurant_name')); ?></label>
                                    <input type="text" name="name[]" class="form-control"  placeholder="<?php echo e(translate('messages.Ex :_ABC Company')); ?>"  maxlength="191">
                                </div>
                                <input type="hidden" name="lang[]" value="default">
                            <?php endif; ?>
                        </div>

                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="form-group mb-0">
                                <label class="form-label" for="tax"><?php echo e(translate('messages.vat/tax')); ?> (%)</label>
                                <input type="number" name="tax" class="form-control"
                                    placeholder="<?php echo e(translate('messages.vat/tax')); ?>" min="0" step=".01" required
                                    value="<?php echo e(old('tax')); ?>">
                            </div>
                        </div>



                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <div class="lang_form default-form" >
                                <div class="form-group mb-0">
                                    <label class="form-label" for="address"><?php echo e(translate('messages.restaurant_address')); ?> (<?php echo e(translate('messages.default')); ?>)</label>
                                    <textarea type="text" name="address[]" class="form-control h--77px"
                                        placeholder="<?php echo e(translate('messages.restaurant_address')); ?>"
                                        ></textarea>
                                </div>
                            </div>
                        


                        <?php if($language): ?>

                        <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="d-none lang_form" id="<?php echo e($lang); ?>-form1">
                            <div class="form-group mb-0">
                                <label class="form-label" for="address"><?php echo e(translate('messages.restaurant_address')); ?> (<?php echo e(strtoupper($lang)); ?>)</label>
                                <textarea type="text" name="address[]" class="form-control h--77px"
                                    placeholder="<?php echo e(translate('messages.restaurant_address')); ?>"></textarea>
                            </div>
                        </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                        <div class="col-sm-3 col-md-2 col-lg-2">
                            <div class="form-group mb-0">
                                <label class="form-label"
                                    for="minimum_delivery_time"><?php echo e(translate('messages.min_delivery_time')); ?></label>
                                <input type="number" name="minimum_delivery_time" class="form-control" placeholder="30"
                                    pattern="^[0-9]{2}$" required value="<?php echo e(old('minimum_delivery_time')); ?>">
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-2 col-lg-2">
                            <div class="form-group mb-0">
                                <label class="form-label"
                                    for="maximum_delivery_time"><?php echo e(translate('messages.max_delivery_time')); ?></label>
                                <input type="number" name="maximum_delivery_time" class="form-control" placeholder="40"
                                    pattern="[0-9]{2}" required value="<?php echo e(old('maximum_delivery_time')); ?>">
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-2 col-lg-2">
                            <div class="form-group mb-0">
                            <label class="form-label"
                            for="maximum_delivery_time"></label>
                            <select name="delivery_time_type" required id="delivery_time_type" class="form-control js-select2-custom select2-container--default">
                                <option selected value="min"><?php echo e(translate('messages.Minutes')); ?></option>
                                <option value="hours" ><?php echo e(translate('messages.Hours')); ?></option>
                            </select>
                        </div>
                        </div>
                    </div>
                    <div class="mt-29px">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <center>
                                        <img class="landing-initial-1" id="coverImageViewer" src="<?php echo e(dynamicAsset('/public/assets/landing/img/restaurant-cover.png')); ?>" alt="Product thumbnail" />
                                    </center>
                                    <div class="landing-input-file-grp">
                                        <label for="name" class="form-label pt-3"><?php echo e(translate('messages.restaurant_cover_photo')); ?> <span
                                                class="text-danger">(<?php echo e(translate('messages.ratio')); ?>

                                                2:1)</span></label>
                                        <label class="custom-file">
                                            <input type="file" name="cover_photo" id="coverImageUpload" class="form-control"
                                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <center>
                                        <img class="landing-initial-1" id="logoImageViewer" src="<?php echo e(dynamicAsset('/public/assets/landing/img/restaurant-logo.png')); ?>" alt="Product thumbnail" />
                                    </center>
                                    <div class="landing-input-file-grp">
                                        <label class="form-label pt-3"><?php echo e(translate('messages.restaurant_logo')); ?><small class="text-danger"> (
                                                <?php echo e(translate('messages.ratio')); ?>

                                                1:1
                                                )</small></label>
                                        <label class="custom-file">
                                            <input type="file" name="logo" id="customFileEg1" class="form-control"
                                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label mb-2 pb-1" for="cuisine"><?php echo e(translate('messages.cuisine')); ?>

                                </label>
                                <select name="cuisine_ids[]" id="cuisine"  class="form-control js-select2-custom select2-container--default"
                                multiple="multiple"  data-placeholder="<?php echo e(translate('messages.select_Cuisine')); ?>" >
                                    <option value="" disabled><?php echo e(translate('messages.select_Cuisine')); ?></option>
                                    <?php $__currentLoopData = \App\Models\Cuisine::where('status',1 )->get(['id','name']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($cu->id); ?>"><?php echo e($cu->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label mb-2 pb-1" for="choice_zones"><?php echo e(translate('messages.zone')); ?>

                                    <span class="input-label-secondary ps-1" title="<?php echo e(translate('messages.select_zone_for_map')); ?>"><img
                                            src="<?php echo e(dynamicAsset('/public/assets/admin/img/info-circle.svg')); ?>"
                                            alt="<?php echo e(translate('messages.select_zone_for_map')); ?>"></span>
                                        </label>
                                <select name="zone_id" id="choice_zones" required class="form-control js-select2-custom select2-container--default"
                                    data-placeholder="<?php echo e(translate('messages.select_zone')); ?>">
                                    <option value="" selected disabled><?php echo e(translate('messages.select_zone')); ?></option>
                                    <?php $__currentLoopData = \App\Models\Zone::active()->get(['id','name']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(isset(auth('admin')->user()->zone_id)): ?>
                                            <?php if(auth('admin')->user()->zone_id == $zone->id): ?>
                                                <option value="<?php echo e($zone->id); ?>" selected><?php echo e($zone->name); ?></option>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <option value="<?php echo e($zone->id); ?>"><?php echo e($zone->name); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label mb-2 pb-1" for="latitude"><?php echo e(translate('messages.latitude')); ?><span
                                        class="input-label-secondary ps-1"
                                        title="<?php echo e(translate('messages.restaurant_lat_lng_warning')); ?>"><img
                                            src="<?php echo e(dynamicAsset('/public/assets/admin/img/info-circle.svg')); ?>"
                                            alt="<?php echo e(translate('messages.restaurant_lat_lng_warning')); ?>"></span></label>
                                <input type="text" id="latitude" name="latitude" class="form-control"
                                    placeholder="<?php echo e(translate('messages.Ex :')); ?> -94.22213" value="<?php echo e(old('latitude')); ?>" required readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label mb-2 pb-1" for="longitude"><?php echo e(translate('messages.longitude')); ?><span
                                        class="input-label-secondary ps-1"
                                        title="<?php echo e(translate('messages.restaurant_lat_lng_warning')); ?>"><img
                                            src="<?php echo e(dynamicAsset('/public/assets/admin/img/info-circle.svg')); ?>"
                                            alt="<?php echo e(translate('messages.restaurant_lat_lng_warning')); ?>"></span></label>
                                <input type="text" name="longitude" class="form-control" placeholder="<?php echo e(translate('messages.Ex :')); ?> 103.344322"
                                    id="longitude" value="<?php echo e(old('longitude')); ?>" required readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12 col-sm-12 mt-4">
                        <input id="pac-input" class="controls rounded landing-initial-2" title="<?php echo e(translate('messages.search_your_location_here')); ?>" type="text" placeholder="<?php echo e(translate('messages.search_here')); ?>"/>
                        <div id="map"></div>
                    </div>
                    <h5 class="card-title mb-3 text--primary text-capitalize mt-4 pt-1">
                        <?php echo e(translate('messages.owner_info')); ?>

                    </h5>
                    <div class="row">
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="f_name"><?php echo e(translate('messages.first_name')); ?></label>
                                <input type="text" name="f_name" class="form-control"
                                    placeholder="<?php echo e(translate('messages.first_name')); ?>"
                                    value="<?php echo e(old('f_name')); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="l_name"><?php echo e(translate('messages.last_name')); ?></label>
                                <input type="text" name="l_name" class="form-control"
                                    placeholder="<?php echo e(translate('messages.last_name')); ?>"
                                    value="<?php echo e(old('l_name')); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="phone"><?php echo e(translate('messages.phone')); ?></label>
                                <input type="tel" name="phone" class="form-control" placeholder="<?php echo e(translate('messages.Ex :')); ?> 017********"
                                    value="<?php echo e(old('phone')); ?>" required>
                            </div>


                        </div>
                    </div>


                    <h5 class="card-title my-1 text--primary text-capitalize mt-4 pt-1">
                        <?php echo e(translate('messages.tags')); ?>

                    </h5>

                    <div class="row mt-3">
                        <div class="col-lg-12">
                            <input type="text" class="form-control" name="tags" placeholder="Enter tags" data-role="tagsinput">
                        </div>
                    </div>


                    <?php if(isset($page_data) && count($page_data) > 0 ): ?>
                    <div class="col-lg-12">
                                <h5 class="card-title my-1 text--primary text-capitalize mt-4 pt-1">
                                    <?php echo e(translate('messages.Additional_Data')); ?>

                                </h5>
                                <div class="row">
                                    <?php $__currentLoopData = data_get($page_data,'data',[]); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <?php if(!in_array($item['field_type'], ['file' , 'check_box']) ): ?>

                                            <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="<?php echo e($item['input_data']); ?>"><?php echo e(translate($item['input_data'])); ?></label>
                                                    <input id="<?php echo e($item['input_data']); ?>" <?php echo e($item['is_required']  == 1? 'required' : ''); ?> type="<?php echo e($item['field_type']); ?>" name="additional_data[<?php echo e($item['input_data']); ?>]" class="form-control h--45px"
                                                        placeholder="<?php echo e(translate($item['placeholder_data'])); ?>"
                                                        value="" >
                                                </div>
                                            </div>

                                            <?php elseif($item['field_type'] == 'check_box' ): ?>
                                                <?php if($item['check_data'] != null): ?>
                                                <div class="col-md-4 col-12">
                                                <div class="form-group">
                                                    <label for=""> <?php echo e(translate($item['input_data'])); ?> </label>
                                                    <?php $__currentLoopData = $item['check_data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=> $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" name="additional_data[<?php echo e($item['input_data']); ?>][]"  class="form-check-input" value="<?php echo e($i); ?>"> <?php echo e(translate($i)); ?>

                                                        </label>
                                                    </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                                </div>
                                                <?php endif; ?>



                                            <?php elseif($item['field_type'] == 'file' ): ?>
                                                <?php if($item['media_data'] != null): ?>
                                                <?php
                                                $image= '';
                                                $pdf= '';
                                                $docs= '';
                                                    if(data_get($item['media_data'],'image',null)){
                                                        $image ='.jpg, .jpeg, .png,';
                                                    }
                                                    if(data_get($item['media_data'],'pdf',null)){
                                                        $pdf =' .pdf,';
                                                    }
                                                    if(data_get($item['media_data'],'docs',null)){
                                                        $docs =' .doc, .docs, .docx' ;
                                                    }
                                                    $accept = $image.$pdf. $docs ;
                                                ?>
                                                    <div class="col-md-4 col-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="<?php echo e($item['input_data']); ?>"><?php echo e(translate($item['input_data'])); ?></label>
                                                            <input id="<?php echo e($item['input_data']); ?>" <?php echo e($item['is_required']  == 1? 'required' : ''); ?> type="<?php echo e($item['field_type']); ?>" name="additional_documents[<?php echo e($item['input_data']); ?>][]" class="form-control h--45px"
                                                                placeholder="<?php echo e(translate($item['placeholder_data'])); ?>"
                                                                    <?php echo e(data_get($item['media_data'],'upload_multiple_files',null) ==  1  ? 'multiple' : ''); ?> accept="<?php echo e($accept ??  '.jpg, .jpeg, .png'); ?>"
                                                                >
                                                        </div>
                                                    </div>

                                                <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                    </div>
                    <?php endif; ?>






                    <h5 class="card-title my-1 text--primary text-capitalize mt-4 pt-1">
                        <?php echo e(translate('messages.login_info')); ?>

                    </h5>
                    <div class="row mt-3">
                        <div class="col-md-4 col-sm-12 col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="email"><?php echo e(translate('messages.email')); ?></label>
                                <input type="email" name="email" class="form-control" placeholder="<?php echo e(translate('messages.Ex :')); ?> ex@example.com"
                                    value="<?php echo e(old('email')); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-lg-4">
                            <div class="form-group">
                                <label class="form-label"
                                    for="exampleInputPassword"><?php echo e(translate('messages.password')); ?>

                                    <span class="input-label-secondary ps-1" title="<?php echo e(translate('messages.Must_contain_at_least_one_number_and_one_uppercase_and_lowercase_letter_and_symbol,_and_at_least_8_or_more_characters')); ?>"><img src="<?php echo e(dynamicAsset('/public/assets/admin/img/info-circle.svg')); ?>" alt="<?php echo e(translate('messages.Must_contain_at_least_one_number_and_one_uppercase_and_lowercase_letter_and_symbol,_and_at_least_8_or_more_characters')); ?>"></span>
                                </label>
                                <input type="password" name="password"
                                    placeholder="<?php echo e(translate('messages.password_length_8+')); ?>"
                                    class="form-control form-control-user"
                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="<?php echo e(translate('messages.Must_contain_at_least_one_number_and_one_uppercase_and_lowercase_letter_and_symbol,_and_at_least_8_or_more_characters')); ?>"
                                    minlength="6" id="exampleInputPassword" required
                                    value="<?php echo e(old('password')); ?>">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-lg-4">
                            <div class="form-group">
                                <label class="form-label"
                                    for="signupSrConfirmPassword"><?php echo e(translate('messages.confirm_password')); ?></label>
                                <input type="password" name="confirm-password" class="form-control form-control-user"
                                    minlength="6" id="exampleRepeatPassword"
                                    placeholder="<?php echo e(translate('messages.password_length_8+')); ?>"
                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="<?php echo e(translate('messages.Must_contain_at_least_one_number_and_one_uppercase_and_lowercase_letter_and_symbol,_and_at_least_8_or_more_characters')); ?>"
                                    required value="<?php echo e(old('confirm-password')); ?>">
                                <div class="pass invalid-feedback"><?php echo e(translate('messages.password_not_matched')); ?></div>
                            </div>

                        </div>
                    </div>
                    <div class="btn--container justify-content-end mt-3">
                        <button type="reset" class="btn btn--reset"><?php echo e(translate('messages.reset')); ?></button>
                        <button type="submit" class="btn btn--primary submitBtn"><?php echo e(translate('messages.next')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </section>
        <!-- Page Header Gap -->
        <div class="h-148px"></div>
        <!-- Page Header Gap -->

    <?php $__env->stopSection(); ?>
    <?php $__env->startPush('script_2'); ?>
        <script src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/js/tags-input.min.js"></script>
        <script src="<?php echo e(dynamicAsset('public/assets/admin/js/spartan-multi-image-picker.js')); ?>"></script>
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <script
                src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(\App\Models\BusinessSetting::where('key', 'map_api_key')->first()->value); ?>&libraries=drawing,places&v=3.45.8">
        </script>
        <script>
            "use strict";
        <?php if($errors->any()): ?>

                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    toastr.error('<?php echo e($error); ?>', Error, {
                    CloseButton: true,
                    ProgressBar: true
                    });
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php endif; ?>
            $('#exampleInputPassword ,#exampleRepeatPassword').on('keyup', function() {
                let pass = $("#exampleInputPassword").val();
                let passRepeat = $("#exampleRepeatPassword").val();
                if (pass == passRepeat) {
                    $('.pass').hide();
                } else {
                    $('.pass').show();
                }
            });

        function readURL(input, viewer) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#' + viewer).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }


            $("#customFileEg1").change(function() {
                readURL(this, 'logoImageViewer');
            });

            $("#coverImageUpload").change(function() {
                readURL(this, 'coverImageViewer');
            });

            $(function() {
                $("#coba").spartanMultiImagePicker({
                    fieldName: 'identity_image[]',
                    maxCount: 5,
                    rowHeight: '120px',
                    groupClassName: 'col-lg-2 col-md-4 col-sm-4 col-6',
                    maxFileSize: '',
                    placeholderImage: {
                        image: '<?php echo e(dynamicAsset('public/assets/admin/img/400x400/img2.jpg')); ?>',
                        width: '100%'
                    },
                    dropFileLabel: "Drop Here",
                    onAddRow: function(index, file) {

                    },
                    onRenderedPreview: function(index) {

                    },
                    onRemoveRow: function(index) {

                    },
                    onExtensionErr: function(index, file) {
                        toastr.error('<?php echo e(translate('messages.please_only_input_png_or_jpg_type_file')); ?>', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    },
                    onSizeErr: function(index, file) {
                        toastr.error('<?php echo e(translate('messages.file_size_too_big')); ?>', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }
                });
            });

            <?php ($default_location = \App\Models\BusinessSetting::where('key', 'default_location')->first()); ?>
            <?php ($default_location = $default_location->value ? json_decode($default_location->value, true) : 0); ?>
            let myLatlng = {
                lat: <?php echo e($default_location ? $default_location['lat'] : '23.757989'); ?>,
                lng: <?php echo e($default_location ? $default_location['lng'] : '90.360587'); ?>

            };
            let map = new google.maps.Map(document.getElementById("map"), {
                zoom: 13,
                center: myLatlng,
            });
            let zonePolygon = null;
            let infoWindow = new google.maps.InfoWindow({
                content: "<?php echo e(translate('Click_the_map_to_get_Lat/Lng!')); ?>",
                position: myLatlng,
            });
            let bounds = new google.maps.LatLngBounds();

            function initMap() {
                // Create the initial InfoWindow.
                infoWindow.open(map);
                //get current location block
                infoWindow = new google.maps.InfoWindow();
                // Try HTML5 geolocation.
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        (position) => {
                            myLatlng = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude,
                            };
                            infoWindow.setPosition(myLatlng);
                            infoWindow.setContent("<?php echo e(translate('Location_found')); ?>");
                            infoWindow.open(map);
                            map.setCenter(myLatlng);
                        },
                        () => {
                            handleLocationError(true, infoWindow, map.getCenter());
                        }
                    );
                } else {
                    // Browser doesn't support Geolocation
                    handleLocationError(false, infoWindow, map.getCenter());
                }
                //-----end block------
                // Create the search box and link it to the UI element.
            const input = document.getElementById("pac-input");
            const searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);
            let markers = [];
            searchBox.addListener("places_changed", () => {
                const places = searchBox.getPlaces();

                if (places.length == 0) {
                return;
                }
                // Clear out the old markers.
                markers.forEach((marker) => {
                marker.setMap(null);
                });
                markers = [];
                // For each place, get the icon, name and location.
                const bounds = new google.maps.LatLngBounds();
                places.forEach((place) => {
                if (!place.geometry || !place.geometry.location) {
                    console.log("Returned place contains no geometry");
                    return;
                }
                const icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25),
                };
                // Create a marker for each place.
                markers.push(
                    new google.maps.Marker({
                    map,
                    icon,
                    title: place.name,
                    position: place.geometry.location,
                    })
                );

                if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
                });
                map.fitBounds(bounds);
            });
            }
            initMap();

            function handleLocationError(browserHasGeolocation, infoWindow, pos) {
                infoWindow.setPosition(pos);
                infoWindow.setContent(
                    browserHasGeolocation ?
                    "Error: The Geolocation service failed." :
                    "Error: Your browser doesn't support geolocation."
                );
                infoWindow.open(map);
            }
            $('#choice_zones').on('change', function() {
                let id = $(this).val();
                $.get({
                    url: '<?php echo e(url('/')); ?>/admin/zone/get-coordinates/' + id,
                    dataType: 'json',
                    success: function(data) {
                        if (zonePolygon) {
                            zonePolygon.setMap(null);
                        }
                        zonePolygon = new google.maps.Polygon({
                            paths: data.coordinates,
                            strokeColor: "#FF0000",
                            strokeOpacity: 0.8,
                            strokeWeight: 2,
                            fillColor: 'white',
                            fillOpacity: 0,
                        });
                        zonePolygon.setMap(map);
                        zonePolygon.getPaths().forEach(function(path) {
                            path.forEach(function(latlng) {
                                bounds.extend(latlng);
                                map.fitBounds(bounds);
                            });
                        });
                        map.setCenter(data.center);
                        google.maps.event.addListener(zonePolygon, 'click', function(mapsMouseEvent) {
                            infoWindow.close();
                            // Create a new InfoWindow.
                            infoWindow = new google.maps.InfoWindow({
                                position: mapsMouseEvent.latLng,
                                content: JSON.stringify(mapsMouseEvent.latLng.toJSON(),
                                    null, 2),
                            });
                            let coordinates = JSON.stringify(mapsMouseEvent.latLng.toJSON(), null,
                                2);
                            coordinates = JSON.parse(coordinates);

                            document.getElementById('latitude').value = coordinates['lat'];
                            document.getElementById('longitude').value = coordinates['lng'];
                            infoWindow.open(map);
                        });
                    },
                });
            });

    $('select').select2({ width: '100%', placeholder: "Select an Option", allowClear: true });

            $(".lang_link").click(function(e){
                e.preventDefault();
                $(".lang_link").removeClass('active');
                $(".lang_form").addClass('d-none');
                $(this).addClass('active');

                let form_id = this.id;
                let lang = form_id.substring(0, form_id.length - 5);

                console.log(lang);

                $("#"+lang+"-form").removeClass('d-none');
                $("#"+lang+"-form1").removeClass('d-none');
                if(lang == '<?php echo e($default_lang); ?>')
                {
                    $(".from_part_2").removeClass('d-none');
                }
                if(lang == 'default')
                {
                    $(".default-form").removeClass('d-none');
                }
                else
                {
                    $(".from_part_2").addClass('d-none');
                }
            });
</script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.landing.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/vendor-views/auth/register-step-1.blade.php ENDPATH**/ ?>