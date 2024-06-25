<?php $__env->startSection('title', translate('Add_New_Food')); ?>

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
                    <h1 class="page-header-title"><i class="tio-add-circle-outlined"></i> <?php echo e(translate('messages.Add_New_Food')); ?></h1>
                </div>
            </div>
        </div>

        <!-- End Page Header -->
        <form action="javascript:" method="post" id="food_form" enctype="multipart/form-data">
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
                                        placeholder="<?php echo e(translate('messages.new_food')); ?>"

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
                                                placeholder="<?php echo e(translate('messages.new_food')); ?>"
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
                                            placeholder="<?php echo e(translate('messages.new_food')); ?>" >
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
                                <p class="mb-0"><?php echo e(translate('Food_Image')); ?></p>

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
                <div class="col-lg-12">
                    <div class="card shadow--card-2 border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                <span class="card-header-icon mr-2">
                                    <i class="tio-dashboard-outlined"></i>
                                </span>
                                <span> <?php echo e(translate('Restaurants_&_Category_Info')); ?></span>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-sm-6 col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="input-label"
                                            for="exampleFormControlSelect1"><?php echo e(translate('messages.restaurant')); ?> <span class="form-label-secondary text-danger"
                                            data-toggle="tooltip" data-placement="right"
                                            data-original-title="<?php echo e(translate('messages.Required.')); ?>"> *
                                            </span><span
                                                class="input-label-secondary"></span></label>
                                        <select name="restaurant_id" id="restaurant_id"
                                            data-placeholder="<?php echo e(translate('messages.select_restaurant')); ?>"
                                            class="js-data-example-ajax form-control"
                                            oninvalid="this.setCustomValidity('<?php echo e(translate('messages.please_select_restaurant')); ?>')">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="input-label"
                                            for="exampleFormControlSelect1"><?php echo e(translate('messages.category')); ?><span class="form-label-secondary text-danger"
                                            data-toggle="tooltip" data-placement="right"
                                            data-original-title="<?php echo e(translate('messages.Required.')); ?>"> *
                                            </span></label>
                                        <select name="category_id" id="category_id"
                                            class="form-control js-select2-custom get-request"
                                            oninvalid="this.setCustomValidity('Select Category')">
                                            <option value="" selected disabled>
                                                <?php echo e(translate('Select_Category')); ?></option>
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($category['id']); ?>"><?php echo e($category['name']); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="input-label"
                                            for="exampleFormControlSelect1"><?php echo e(translate('messages.sub_category')); ?><span
                                                class="input-label-secondary" data-toggle="tooltip"
                                                data-placement="right"
                                                data-original-title="<?php echo e(translate('messages.category_required_warning')); ?>"><img
                                                    src="<?php echo e(dynamicAsset('/public/assets/admin/img/info-circle.svg')); ?>"
                                                    alt="<?php echo e(translate('messages.category_required_warning')); ?>"></span></label>
                                        <select name="sub_category_id" id="sub-categories"
                                            class="form-control js-select2-custom">
                                            <option value="" selected disabled>
                                                <?php echo e(translate('Select_Sub_Category')); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="form-group mb-0">
                                        <label class="input-label"
                                            for="exampleFormControlInput1"><?php echo e(translate('messages.food_type')); ?><span class="form-label-secondary text-danger"
                                            data-toggle="tooltip" data-placement="right"
                                            data-original-title="<?php echo e(translate('messages.Required.')); ?>"> *
                                            </span></label>
                                        <select name="veg" id="veg"
                                            class="form-control js-select2-custom">
                                            <option value="" selected disabled>
                                                <?php echo e(translate('Select_Preferences')); ?></option>
                                            <option value="0"><?php echo e(translate('messages.non_veg')); ?></option>
                                            <option value="1"><?php echo e(translate('messages.veg')); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3" id="halal">
                                    <div class="form-check mb-0 p-4">
                                        <input class="form-check-input" name="is_halal" type="checkbox" value="1" id="flexCheckDefault" checked>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            <?php echo e(translate('messages.Is_It_Halal')); ?>

                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card shadow--card-2 border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                <span class="card-header-icon mr-2">
                                    <i class="tio-dashboard-outlined"></i>
                                </span>
                                <span><?php echo e(translate('messages.addon')); ?></span>
                            </h5>
                        </div>
                        <div class="card-body">
                            <label class="input-label"
                                for="exampleFormControlSelect1"><?php echo e(translate('Select_Add-on')); ?><span
                                    class="input-label-secondary" data-toggle="tooltip"
                                    data-placement="right"
                                    data-original-title="<?php echo e(translate('messages.The_selected_addon’s_will_be_displayed_in_this_food_details')); ?>"><img
                                        src="<?php echo e(dynamicAsset('/public/assets/admin/img/info-circle.svg')); ?>"
                                        alt="<?php echo e(translate('messages.The_selected_addon’s_will_be_displayed_in_this_food_details')); ?>"></span></label>
                            <select name="addon_ids[]" class="form-control border js-select2-custom"
                                multiple="multiple" id="add_on">

                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card shadow--card-2 border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                <span class="card-header-icon mr-2"><i class="tio-date-range"></i></span>
                                <span><?php echo e(translate('messages.Availability')); ?></span>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-sm-6">
                                    <div class="form-group mb-0">
                                        <label class="input-label"
                                            for="exampleFormControlInput1"><?php echo e(translate('messages.available_time_starts')); ?><span class="form-label-secondary text-danger"
                                            data-toggle="tooltip" data-placement="right"
                                            data-original-title="<?php echo e(translate('messages.Required.')); ?>"> *
                                            </span></label>
                                        <input type="time" name="available_time_starts" class="form-control"
                                            id="available_time_starts"
                                            placeholder="<?php echo e(translate('messages.Ex:_10:30_am')); ?> " required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-0">
                                        <label class="input-label"
                                            for="exampleFormControlInput1"><?php echo e(translate('messages.available_time_ends')); ?><span class="form-label-secondary text-danger"
                                            data-toggle="tooltip" data-placement="right"
                                            data-original-title="<?php echo e(translate('messages.Required.')); ?>"> *
                                            </span></label>
                                        <input type="time" name="available_time_ends" class="form-control"
                                            id="available_time_ends" placeholder="5:45 pm" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card shadow--card-2 border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                <span class="card-header-icon mr-2"><i class="tio-dollar-outlined"></i></span>
                                <span><?php echo e(translate('Price_Information')); ?></span>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-md-3">
                                    <div class="form-group mb-0">
                                        <label class="input-label"
                                            for="exampleFormControlInput1"><?php echo e(translate('messages.Unit_Price')); ?> <?php echo e(\App\CentralLogics\Helpers::currency_symbol()); ?><span class="form-label-secondary text-danger"
                                            data-toggle="tooltip" data-placement="right"
                                            data-original-title="<?php echo e(translate('messages.Required.')); ?>"> *
                                            </span></label>
                                        <input type="number" min="0" max="999999999999.999"
                                            step="0.001" value="1" name="price" class="form-control"
                                            placeholder="<?php echo e(translate('messages.Ex:_100')); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-0">
                                        <label class="input-label"
                                            for="exampleFormControlInput1"><?php echo e(translate('messages.discount_type')); ?>


                                        </label>
                                        <select name="discount_type" class="form-control js-select2-custom">
                                            <option value="percent"><?php echo e(translate('messages.percent').' (%)'); ?></option>
                                            <option value="amount"><?php echo e(translate('messages.amount').' ('.\App\CentralLogics\Helpers::currency_symbol().')'); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-0">
                                        <label class="input-label"
                                            for="exampleFormControlInput1"><?php echo e(translate('messages.discount')); ?>

                                            <span class="form-label-secondary text-danger"
                                            data-toggle="tooltip" data-placement="right"
                                            data-original-title="<?php echo e(translate('messages.Required.')); ?>"> *
                                            </span>
                                            <span class="input-label-secondary text--title" data-toggle="tooltip"
                                            data-placement="right"
                                            data-original-title="<?php echo e(translate('Currently_you_need_to_manage_discount_with_the_Restaurant.')); ?>">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                        </label>
                                        <input type="number" min="0" max="999999999999999"
                                            value="0" name="discount" class="form-control"
                                            placeholder="<?php echo e(translate('messages.Ex:_100')); ?> ">
                                    </div>
                                </div>
                                <div class="col-md-3" id="maximum_cart_quantity">
                                    <div class="form-group mb-0">
                                        <label class="input-label"
                                            for="maximum_cart_quantity"><?php echo e(translate('messages.Maximum_Purchase_Quantity_Limit')); ?>

                                            <span
                                            class="input-label-secondary text--title" data-toggle="tooltip"
                                            data-placement="right"
                                            data-original-title="<?php echo e(translate('If_this_limit_is_exceeded,_customers_can_not_buy_the_food_in_a_single_purchase.')); ?>">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                        </label>
                                        <input type="number"  placeholder="<?php echo e(translate('messages.Ex:_10')); ?>" class="form-control" name="maximum_cart_quantity" min="0" id="cart_quantity">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group mb-0">
                                        <label class="input-label"
                                            for="exampleFormControlInput1"><?php echo e(translate('messages.Stock_Type')); ?>

                                        </label>
                                        <select name="stock_type" id="stock_type" class="form-control js-select2-custom">
                                            <option value="unlimited"><?php echo e(translate('messages.Unlimited_Stock')); ?></option>
                                            <option value="limited"><?php echo e(translate('messages.Limited_Stock')); ?></option>
                                            <option value="daily"><?php echo e(translate('messages.Daily_Stock')); ?></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 hide_this" id="">
                                    <div class="form-group mb-0">
                                        <label class="input-label"
                                            for="item_stock"><?php echo e(translate('messages.Item_Stock')); ?>

                                            <span class="input-label-secondary text--title" data-toggle="tooltip"
                                            data-placement="right"
                                            data-original-title="<?php echo e(translate('This_Stock_amount_will_be_counted_as_the_base_stock._But_if_you_want_to_manage_variation_wise_stock,_then_need__to_manage_it_below_with_food_variation_setup.')); ?>">
                                            <i class="tio-info-outined"></i>
                                        </span>
                                        </label>
                                        <input type="number"  placeholder="<?php echo e(translate('messages.Ex:_10')); ?>" class="form-control stock_disable" name="item_stock" min="0" max="999999999" id="item_stock">
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card shadow--card-2 border-0">
                        <div class="card-header flex-wrap">
                            <h5 class="card-title">
                                <span class="card-header-icon mr-2">
                                    <i class="tio-canvas-text"></i>
                                </span>
                                <span><?php echo e(translate('messages.food_variations')); ?></span>
                            </h5>
                            <a class="btn text--primary-2" id="add_new_option_button">
                                <?php echo e(translate('add_new_variation')); ?>

                                <i class="tio-add"></i>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-md-12">
                                    <div id="add_new_option">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card shadow--card-2 border-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                <span class="card-header-icon mr-2"><i class="tio-label"></i></span>
                                <span><?php echo e(translate('tags')); ?></span>
                            </h5>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" name="tags" placeholder="Enter tags" data-role="tagsinput">
                        </div>
                    </div>
                </div>
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
    <script>


        "use strict";
        $('#stock_type').on('change', function () {
                if($(this).val() == 'unlimited') {
                    $('.stock_disable').prop('readonly', true).prop('required', false).attr('placeholder', '<?php echo e(translate('Unlimited')); ?>').val('');
                    $('.hide_this').addClass('d-none');
                } else {
                    $('.stock_disable').prop('readonly', false).prop('required', true).attr('placeholder', '<?php echo e(translate('messages.Ex:_100')); ?>');
                    $('.hide_this').removeClass('d-none');
                    // if($('.view_new_option').length > 0){
                    //     $('#item_stock').prop('readonly', true).prop('required', false);
                    // }
                }
        });

        updatestockCount();

            function updatestockCount(){
                if($('#stock_type').val()==  'unlimited'){
                        $('.stock_disable').prop('readonly', true).prop('required', false).attr('placeholder', '<?php echo e(translate('Unlimited')); ?>').val('');
                        $('.hide_this').addClass('d-none');
                    } else{
                        $('.stock_disable').prop('readonly', false).prop('required', true).attr('placeholder', '<?php echo e(translate('messages.Ex:_100')); ?>');
                         $('.hide_this').removeClass('d-none');
                    }
                    // if($('.view_new_option').length > 0){
                    //     $('#item_stock').prop('readonly', true).prop('required', false);
                    // }


                    // $(".count_stock").on('input', function() {
                    //     var sum = 0;
                    //     $(".count_stock").each(function() {
                    //         const value = parseFloat($(this).val()) || 0;
                    //         sum += value;
                    //     });
                    //     $("#item_stock").val(sum);
                    // });


            }
    $(document).ready(function() {
            $("#add_new_option_button").click(function(e) {
                $('#empty-variation').hide();
                count++;
                let add_option_view = `
                    <div class="__bg-F8F9FC-card view_new_option mb-2">
                        <div>
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <label class="form-check form--check">
                                    <input id="options[` + count + `][required]" name="options[` + count + `][required]" class="form-check-input" type="checkbox">
                                    <span class="form-check-label"><?php echo e(translate('Required')); ?></span>
                                </label>
                                <div>
                                    <button type="button" class="btn btn-danger btn-sm delete_input_button"
                                        title="<?php echo e(translate('Delete')); ?>">
                                        <i class="tio-add-to-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-xl-4 col-lg-6">
                                    <label for=""><?php echo e(translate('name')); ?>&nbsp;<span class="form-label-secondary text-danger"
                                data-toggle="tooltip" data-placement="right"
                                data-original-title="<?php echo e(translate('messages.Required.')); ?>"> *
                                </span></label>
                                    <input required name=options[` + count +
                    `][name] class="form-control new_option_name" type="text" data-count="`+
                    count +`">
                                </div>

                                <div class="col-xl-4 col-lg-6">
                                    <div>
                                        <label class="input-label text-capitalize d-flex align-items-center"><span class="line--limit-1"><?php echo e(translate('messages.Variation_Selection_Type')); ?> </span>
                                        </label>
                                        <div class="resturant-type-group px-0">
                                            <label class="form-check form--check mr-2 mr-md-4">
                                                <input class="form-check-input show_min_max" data-count="`+count+`" type="radio" value="multi"
                                                name="options[` + count + `][type]" id="type` + count +
                    `" checked
                                                >
                                                <span class="form-check-label">
                                                    <?php echo e(translate('Multiple Selection')); ?>

                    </span>
                </label>

                <label class="form-check form--check mr-2 mr-md-4">
                    <input class="form-check-input hide_min_max" data-count="`+count+`" type="radio" value="single"
                    name="options[` + count + `][type]" id="type` + count +
                    `"
                                                >
                                                <span class="form-check-label">
                                                    <?php echo e(translate('Single Selection')); ?>

                    </span>
                </label>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-6">
        <div class="row g-2">
            <div class="col-6">
                <label for=""><?php echo e(translate('Min_Option_to_Select')); ?></label>
                                            <input id="min_max1_` + count + `" required  name="options[` + count + `][min]" class="form-control" type="number" min="1">
                                        </div>
                                        <div class="col-6">
                                            <label for=""><?php echo e(translate('Max_Option_to_Select')); ?></label>
                                            <input id="min_max2_` + count + `"   required name="options[` + count + `][max]" class="form-control" type="number" min="1">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="option_price_` + count + `" >
                                <div class="bg-white border rounded p-3 pb-0 mt-3">
                                    <div  id="option_price_view_` + count + `">
                                        <div class="row g-3 add_new_view_row_class mb-3">
                                            <div class="col-md-3 col-sm-6">
                                                <label for=""><?php echo e(translate('Option_name')); ?> &nbsp;<span class="form-label-secondary text-danger"
                                data-toggle="tooltip" data-placement="right"
                                data-original-title="<?php echo e(translate('messages.Required.')); ?>"> *
                                </span></label>
                                                <input class="form-control" required type="text" name="options[` +
                    count +
                    `][values][0][label]" id="">
                                            </div>
                                            <div class="col-md-3 col-sm-6">
                                                <label for=""><?php echo e(translate('Additional_price')); ?> (<?php echo e(\App\CentralLogics\Helpers::currency_symbol()); ?>)&nbsp;<span class="form-label-secondary text-danger"
                                data-toggle="tooltip" data-placement="right"
                                data-original-title="<?php echo e(translate('messages.Required.')); ?>"> *
                                </span></label>
                                                <input class="form-control" required type="number" min="0" step="0.01" name="options[` +
                    count + `][values][0][optionPrice]" id="">
                                            </div>
                                            <div class="col-md-3 col-sm-6 hide_this">
                                                <label for=""><?php echo e(translate('Stock')); ?></label>
                                                <input class="form-control stock_disable count_stock" required type="number" min="0" max="9999999" name="options[` +
                    count + `][values][0][total_stock]" id="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3 p-3 mr-1 d-flex "  id="add_new_button_` + count +
                    `">
                                        <button type="button" class="btn btn--primary btn-outline-primary add_new_row_button" data-count="`+
                    count +`"><?php echo e(translate('Add_New_Option')); ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;

                $("#add_new_option").append(add_option_view);
                updatestockCount();
            });
        });

        function add_new_row_button(data) {
            count = data;
            countRow = 1 + $('#option_price_view_' + data).children('.add_new_view_row_class').length;
            let add_new_row_view = `
            <div class="row add_new_view_row_class mb-3 position-relative pt-3 pt-sm-0">
                <div class="col-md-3 col-sm-5">
                        <label for=""><?php echo e(translate('Option_name')); ?> &nbsp;<span class="form-label-secondary text-danger"
                                data-toggle="tooltip" data-placement="right"
                                data-original-title="<?php echo e(translate('messages.Required.')); ?>"> *
                                </span></label>
                        <input class="form-control" required type="text" name="options[` + count + `][values][` + countRow + `][label]" id="">
                    </div>
                    <div class="col-md-3 col-sm-5">
                        <label for=""><?php echo e(translate('Additional_price')); ?> (<?php echo e(\App\CentralLogics\Helpers::currency_symbol()); ?>)&nbsp;<span class="form-label-secondary text-danger"
                                data-toggle="tooltip" data-placement="right"
                                data-original-title="<?php echo e(translate('messages.Required.')); ?>"> *
                                </span></label>
                        <input class="form-control"  required type="number" min="0" step="0.01" name="options[` +
                count + `][values][` + countRow + `][optionPrice]" id="">
                    </div>


                    <div class="col-md-3 col-sm-6 hide_this">
                                                <label for=""><?php echo e(translate('Stock')); ?></label>
                                                <input class="form-control stock_disable count_stock" required type="number" min="0" max="9999999" name="options[` +
                count + `][values][` + countRow + `][total_stock]" id="">
                                            </div>


                    <div class="col-sm-2 max-sm-absolute">
                        <label class="d-none d-sm-block">&nbsp;</label>
                        <div class="mt-1">
                            <button type="button" class="btn btn-danger btn-sm deleteRow"
                                title="<?php echo e(translate('Delete')); ?>">
                                <i class="tio-add-to-trash"></i>
                            </button>
                        </div>
                </div>
            </div>`;
            $('#option_price_view_' + data).append(add_new_row_view);
            updatestockCount();

        }

        $('#restaurant_id').on('change', function () {
            let route = '<?php echo e(url('/')); ?>/admin/restaurant/get-addons?data[]=0&restaurant_id=';
            let restaurant_id = $(this).val();
            let id = 'add_on';
            getRestaurantData(route,restaurant_id, id);

        });
        function getRestaurantData(route, restaurant_id, id) {
            $.get({
                url: route + restaurant_id,
                dataType: 'json',
                success: function(data) {
                    $('#' + id).empty().append(data.options);
                },
            });
        }

        $('.get-request').on('change', function () {
            let route = '<?php echo e(url('/')); ?>/admin/food/get-categories?parent_id='+$(this).val();
            let id = 'sub-categories';
            getRequest(route, id);
        });

        function getRequest(route, id) {
            $.get({
                url: route,
                dataType: 'json',
                success: function(data) {
                    $('#' + id).empty().append(data.options);
                },
            });
        }

        $(document).on('ready', function() {
            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function() {
                let select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });
        $('.js-data-example-ajax').select2({
            ajax: {
                url: '<?php echo e(url('/')); ?>/admin/restaurant/get-restaurants',
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                __port: function(params, success, failure) {
                    let $request = $.ajax(params);

                    $request.then(success);
                    $request.fail(failure);

                    return $request;
                }
            }
        });

        $('#food_form').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('admin.food.store')); ?>',
                data: $('#food_form').serialize(),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(data) {
                    $('#loading').hide();
                    if (data.errors) {
                        for (let i = 0; i < data.errors.length; i++) {
                            toastr.error(data.errors[i].message, {
                                CloseButton: true,
                                ProgressBar: true
                            });
                        }
                    } else {
                        toastr.success('<?php echo e(translate('messages.product_added_successfully')); ?>', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                        setTimeout(function() {
                            location.href =
                                '<?php echo e(route('admin.food.list')); ?>';
                        }, 2000);
                    }
                }
            });
        });

        $('#reset_btn').click(function() {
            $('#restaurant_id').val(null).trigger('change');
            $('#category_id').val(null).trigger('change');
            $('#categories').val(null).trigger('change');
            $('#sub-veg').val(0).trigger('change');
            $('#add_on').val(null).trigger('change');
            $('#viewer').attr('src', "<?php echo e(dynamicAsset('public/assets/admin/img/upload.png')); ?>");
            $('#stock_type').val('unlimited').trigger('change');
            updatestockCount();
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/product/index.blade.php ENDPATH**/ ?>