<?php $__env->startSection('title', $zone->name); ?>

<?php $__env->startPush('css_or_js'); ?>
    <!-- Custom styles for this page -->
    <link href="<?php echo e(dynamicAsset('public/assets/admin/css/croppie.css')); ?>" rel="stylesheet">
    <style>
        .sortable-placeholder {
            background-color: #f0f0f0;
            border: 1px dashed #ccc;
            height: 100px;
            /* Adjust height to match your elements */
            margin: 10px 0;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <h1 class="page-header-title text-break me-2">
                    <i class="tio-shop"></i> <span><?php echo e($zone->name); ?></span>
                </h1>
              
                

              
               

            </div>

        </div>
        <!-- End Page Header -->
        <!-- Page Heading -->
        <div class="content container-fluid">
           
                <div class="drg">
                    <div class="page-header d-flex justify-content-between">
                        <h1 class="page-header-title">

                            <span>Resturants</span>
                        </h1>



                        <hr>
                    </div>
                    <div class="disbursement-report mb-20">

                        <?php $__currentLoopData = $RestCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="__card-3 food rebursement-item" data-id="<?php echo e($category->id); ?>">
                                <div class="info-icon" data-toggle="tooltip" data-placement="top"
                                    data-original-title="All the pending disbursement requests that require admin’s action (complete/cancel)."
                                    aria-describedby="tooltip624691">
                                    <img src="http://127.0.0.1:8000/assets/admin/img/report/new/info1.png" alt="report/new">
                                </div>
                                <img class="icon"
                                    src="<?php echo e(\App\CentralLogics\Helpers::onerror_image_helper($category['image'], dynamicStorage('storage/app/public/category/').'/'.$category['image'], dynamicAsset('/public/assets/admin/img/900x400/img1.jpg'), 'category/')); ?>"
                                    data-onerror-image="<?php echo e(dynamicAsset('public/assets/admin/img/100x100/food-default-image.png')); ?>"
                                    alt="<?php echo e($category->name); ?> image">
                                  
                                <h6 class="subtitle"><?php echo e($category->name); ?></h6>

                                <hr>

                                <div class="d-flex justify-content-center align-items-center">
                                   

                                    <div class="btn--container">
                                        <a class="btn btn-sm btn--primary btn-outline-primary action-btn"
                                            href="<?php echo e(route('admin.food.edit', [$category['id']])); ?>"
                                            title="<?php echo e(translate('messages.edit_food')); ?>"><i class="tio-edit"></i>
                                        </a>
                                        <a class="btn btn-sm btn--danger btn-outline-danger action-btn form-alert"
                                            href="javascript:" data-id="food-<?php echo e($category['id']); ?>"
                                            data-message="<?php echo e(translate('Want_to_delete_this_food_?')); ?>"
                                            title="<?php echo e(translate('messages.delete_food')); ?>"><i
                                                class="tio-delete-outlined"></i>
                                        </a>
                                    </div>
                                    <div class="btn--container">

                                        <form action="<?php echo e(route('admin.zone.category.delete', [$category['id']])); ?>" method="post"
                                            id="zone.category-<?php echo e($category['id']); ?>">
                                            <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                        </form>
                                    </div>

                                </div>
                                
                                <hr class="py-2">
                               

                                <div class="d-flex justify-content-center align-items-center">

                                    <div class="btn--container">
                                        <label class="toggle-switch toggle-switch-sm ml-2 sts-fld"
                                            data-url="<?php echo e(route('admin.zone.category.status', [$category['id'], $category->status ? 0 : 1])); ?>"
                                            for="stocksCheckbox<?php echo e($category->id); ?>">
                                            
                                            <input type="checkbox" class="toggle-switch-input"
                                                id="stocksCheckbox<?php echo e($category->id); ?>"
                                                <?php echo e($category->status ? 'checked' : ''); ?>>
                                            <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </div>
    
                                    </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div data-zoneId="<?php echo e($zone->id); ?>" class="__card-3 rebursement-item add_new"
                            data-toggle="modal" data-target="#addSystemModal">
                            <div class="info-icon" data-toggle="tooltip" data-placement="top"
                                data-original-title="All the pending disbursement requests that require admin’s action (complete/cancel)."
                                aria-describedby="tooltip624691">
                                <img src="http://127.0.0.1:8000/assets/admin/img/report/new/info1.png" alt="report/new">
                            </div>
                            <img class="icon"
                                src="https://assets.dryicons.com/uploads/icon/svg/12629/b1694dd4-c66a-40d0-8f95-bdd8131494be.svg"
                                data-onerror-image="https://assets.dryicons.com/uploads/icon/svg/12629/b1694dd4-c66a-40d0-8f95-bdd8131494be.svg"
                                alt=" image">
                            <h6 class="subtitle"><?php echo e(translate('messages.add_new')); ?></h6>

                        </div>
                    </div>
                </div>



                <div class="drg">
                    <div class="page-header d-flex justify-content-between">
                        <h1 class="page-header-title">

                            <span>Markets</span>
                        </h1>



                        <hr>
                    </div>
                    <div class="disbursement-report mb-20">

                        <?php $__currentLoopData = $MarketCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="__card-3 food rebursement-item" data-id="<?php echo e($category->id); ?>">
                                <div class="info-icon" data-toggle="tooltip" data-placement="top"
                                    data-original-title="All the pending disbursement requests that require admin’s action (complete/cancel)."
                                    aria-describedby="tooltip624691">
                                    <img src="http://127.0.0.1:8000/assets/admin/img/report/new/info1.png" alt="report/new">
                                </div>
                                <img class="icon"
                                    src="<?php echo e(\App\CentralLogics\Helpers::onerror_image_helper($category['image'], dynamicStorage('storage/app/public/category/').'/'.$category['image'], dynamicAsset('/public/assets/admin/img/900x400/img1.jpg'), 'category/')); ?>"
                                    data-onerror-image="<?php echo e(dynamicAsset('public/assets/admin/img/100x100/food-default-image.png')); ?>"
                                    alt="<?php echo e($category->name); ?> image">
                                  
                                <h6 class="subtitle"><?php echo e($category->name); ?></h6>

                                <hr>

                                <div class="d-flex justify-content-center align-items-center">
                                   

                                    <div class="btn--container">
                                        <a class="btn btn-sm btn--primary btn-outline-primary action-btn"
                                            href="<?php echo e(route('admin.food.edit', [$category['id']])); ?>"
                                            title="<?php echo e(translate('messages.edit_food')); ?>"><i class="tio-edit"></i>
                                        </a>
                                        <a class="btn btn-sm btn--danger btn-outline-danger action-btn form-alert"
                                            href="javascript:" data-id="food-<?php echo e($category['id']); ?>"
                                            data-message="<?php echo e(translate('Want_to_delete_this_food_?')); ?>"
                                            title="<?php echo e(translate('messages.delete_food')); ?>"><i
                                                class="tio-delete-outlined"></i>
                                        </a>
                                    </div>
                                    <div class="btn--container">

                                        <form action="<?php echo e(route('admin.zone.category.delete', [$category['id']])); ?>" method="post"
                                            id="zone.category-<?php echo e($category['id']); ?>">
                                            <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                        </form>
                                    </div>

                                </div>
                                
                                <hr class="py-2">
                               
                                <div class="d-flex justify-content-center align-items-center">

                                    <div class="btn--container">
                                        <label class="toggle-switch toggle-switch-sm ml-2 sts-fld"
                                            data-url="<?php echo e(route('admin.zone.category.status', [$category['id'], $category->status ? 0 : 1])); ?>"
                                            for="stocksCheckbox<?php echo e($category->id); ?>">
                                            
                                            <input type="checkbox" class="toggle-switch-input"
                                                id="stocksCheckbox<?php echo e($category->id); ?>"
                                                <?php echo e($category->status ? 'checked' : ''); ?>>
                                            <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                        </label>
                                    </div>
    
                                    </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div data-zoneId="<?php echo e($zone->id); ?>" class="__card-3 rebursement-item add_new"
                            data-toggle="modal" data-target="#addSystemModal">
                            <div class="info-icon" data-toggle="tooltip" data-placement="top"
                                data-original-title="All the pending disbursement requests that require admin’s action (complete/cancel)."
                                aria-describedby="tooltip624691">
                                <img src="http://127.0.0.1:8000/assets/admin/img/report/new/info1.png" alt="report/new">
                            </div>
                            <img class="icon"
                                src="https://assets.dryicons.com/uploads/icon/svg/12629/b1694dd4-c66a-40d0-8f95-bdd8131494be.svg"
                                data-onerror-image="https://assets.dryicons.com/uploads/icon/svg/12629/b1694dd4-c66a-40d0-8f95-bdd8131494be.svg"
                                alt=" image">
                            <h6 class="subtitle"><?php echo e(translate('messages.add_new')); ?></h6>

                        </div>
                    </div>
                </div>
            
        </div>

        <!-- Modal -->
        <div class="modal fade " id="addSystemModal" tabindex="-1">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title" id="exampleModalLabel"><?php echo e(translate('messages.Category_Setup')); ?> </h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-30">

                        <!-- End Page Header -->
                        <form action="<?php echo e(route('admin.zone.add_new_category')); ?>" method="post" id="food_form" enctype="multipart/form-data">
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
                                                

                                                <div class="form-group">
                                                    <input hidden name="status" value="0" />
                                                    <label class="toggle-switch toggle-switch-sm">
                                                        Is Markets Category ?
                                                        <input type="checkbox" class="toggle-switch-input"
                                                            name="status"
                                                            value="1"
                                                            data-type="status"
                                                            data-image-on='<?php echo e(dynamicAsset('/public/assets/admin/img/modal')); ?>/zone-status-on.png'
                                                            data-image-off="<?php echo e(dynamicAsset('/public/assets/admin/img/modal')); ?>/zone-status-off.png"
                                                            data-title-on="<?php echo e(translate('Want_to_activate_Market_in_this_Zone?')); ?>"
                                                            data-title-off="<?php echo e(translate('Want_to_deactivate_Market_in_this_Zone?')); ?>"
                                                            data-text-on="<p><?php echo e(translate('If_you_activate_this_zone,_Customers_can_see_all_restaurants_&_products_available_under_this_Zone_from_the_Customer_App_&_Website.')); ?></p>"
                                                            data-text-off="<p><?php echo e(translate('If_you_deactivate_this_zone,_Customers_Will_NOT_see_all_restaurants_&_products_available_under_this_Zone_from_the_Customer_App_&_Website.')); ?></p>">
                                                        <span class="toggle-switch-label">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                    </label>
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
                                                <p class="mb-0"><?php echo e(translate('Category_Image')); ?></p>
                
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
                                <input hidden name="zone_id" value="<?php echo e($zone->id); ?>" />
                                
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
                </div>
            </div>
        </div>
      
    </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/js/tags-input.min.js"></script>
    <script src="<?php echo e(dynamicAsset('public/assets/admin/js/spartan-multi-image-picker.js')); ?>"></script>
    <script src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/js/view-pages/product-index.js"></script>

    <script src="https://code.jquery.com/ui/1.14.0-beta.1/jquery-ui.min.js"
        integrity="sha256-eTkBotE66yiuQ4Th2m+9M00ivksRSCZHIphWprTOFls=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

    <script>
        $(document).ready(function() {
         


          

           
        });
    </script>
   

    <script>
        $(document).on('click', '.sts-fld', function(e) {
            //e.preventDefault();
            const id = $(this).data('id');
            const url = $(this).data('url');
           
            const checkedValue = $(this).is(":checked");
            $.ajax({
                type: "GET",
                url: url,
                data: {
                    'id': id
                },
                success: function(data) {
                    if (data.type === 'yes') {
                        $(this).prop("checked", checkedValue);
                    } else if (data.type === 'no') {
                        $(this).prop("checked", !checkedValue);
                    }
                    toastr.success('<?php echo e(translate('messages.category_status_updated')); ?>', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });
        });


        $(document).on('click', '.market-fld', function(e) {
            //e.preventDefault();
            const id = $(this).data('id');
            const url = $(this).data('url');
           
            const checkedValue = $(this).is(":checked");
            $.ajax({
                type: "GET",
                url: url,
                data: {
                    'id': id
                },
                success: function(data) {
                    if (data.type === 'yes') {
                        $(this).prop("checked", checkedValue);
                    } else if (data.type === 'no') {
                        $(this).prop("checked", !checkedValue);
                    }
                    toastr.success('<?php echo e(translate('messages.the_category_support_market_now')); ?>', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });
        });


        
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/zone/categories.blade.php ENDPATH**/ ?>