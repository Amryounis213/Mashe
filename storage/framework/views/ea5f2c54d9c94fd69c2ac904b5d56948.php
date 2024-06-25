<?php $__env->startSection('title',translate('messages.Add new cuisine')); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h2 class="page-header-title text-capitalize">
                        <div class="card-header-icon d-inline-flex mr-2 img">
                            <img src="<?php echo e(dynamicAsset('public/assets/admin/img/zone.png')); ?>" alt="">
                        </div>
                        <span>
                            <?php echo e(translate('cuisine')); ?>

                        </span>
                    </h2>
                </div>
            </div>
        </div>
        <!-- End Page Header -->

        <div class="card mt-3">
            <div class="card-header py-2">
                <div class="search--button-wrapper">
                    <h5 class="card-title"><span class="card-header-icon">
                        <i class="tio-cuisine-outlined"></i>
                    </span> <?php echo e(translate('messages.cuisine_list')); ?><span class="badge badge-soft-dark ml-2" id="itemCount"><?php echo e($cuisine->total()); ?></span></h5>
                    <form >
                        <!-- Search -->
                        <div class="input--group input-group input-group-merge input-group-flush">
                            <input type="search" value="<?php echo e(request()?->search ?? null); ?>" name="search" class="form-control" placeholder="<?php echo e(translate('Ex:_search_by_name')); ?>" aria-label="<?php echo e(translate('messages.search_cuisine')); ?>">
                            <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>
                        </div>
                        <!-- End Search -->
                    </form>

                    <div class="hs-unfold">
                        <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle btn export-btn export--btn btn-outline-primary btn--primary font--sm" href="javascript:;"
                            data-hs-unfold-options='{
                                "target": "#usersExportDropdown",
                                "type": "css-animation"
                            }'>
                            <i class="tio-download-to mr-1"></i> <?php echo e(translate('messages.export')); ?>

                        </a>

                        <div id="usersExportDropdown"
                                class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">

                            <span class="dropdown-header"><?php echo e(translate('messages.download_options')); ?></span>
                            <a id="export-excel" class="dropdown-item" href="<?php echo e(route("admin.cuisine.export",['type'=>'excel' , request()->getQueryString() ])); ?>">
                                <img class="avatar avatar-xss avatar-4by3 mr-2"
                                        src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/svg/components/excel.svg"
                                        alt="Image Description">
                                <?php echo e(translate('messages.excel')); ?>

                            </a>
                            <a id="export-csv" class="dropdown-item" href="<?php echo e(route("admin.cuisine.export",['type'=>'csv' , request()->getQueryString() ])); ?>">
                                <img class="avatar avatar-xss avatar-4by3 mr-2"
                                        src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/svg/components/placeholder-csv-format.svg"
                                        alt="Image Description">
                                <?php echo e(translate('messages.csv')); ?>

                            </a>
                        </div>
                    </div>
                    <button type="button" class="btn btn--primary" data-toggle="modal" data-target="#add_new_cuisine">
                        <?php echo e(translate('Add_New_Cuisine')); ?>

                    </button>
                </div>
            </div>
            <div class="table-responsive datatable-custom">
                <table id="columnSearchDatatable"
                    class="table table-borderless table-thead-bordered table-align-middle"
                    data-hs-datatables-options='{
                        "isResponsive": false,
                        "isShowPaging": false,
                        "paging":false,
                    }'>
                    <thead class="thead-light">
                        <tr>
                            <th class="w-25px" > <?php echo e(translate('messages.sl')); ?></th>
                            <th class="w-25px"><?php echo e(translate('messages.cuisine_id')); ?></th>
                            <th class="w-130px"><?php echo e(translate('messages.cuisine_name')); ?></th>
                            <th class="text-center w-130px"><?php echo e(translate('messages.total_restaurant')); ?></th>
                            <th class="text-center w-130px"> <?php echo e(translate('messages.status')); ?></th>
                            <th class="text-center w-130px"><?php echo e(translate('messages.action')); ?></th>
                        </tr>
                    </thead>

                    <tbody id="table-div">
                    <?php $__currentLoopData = $cuisine; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$cu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <div class="pl-3">
                                    <?php echo e($key+$cuisine->firstItem()); ?>

                                </div>
                            </td>
                            <?php ($img_src =  isset($cu->image) ?  dynamicStorage('storage/app/public/cuisine').'/'.$cu['image'] : dynamicAsset('public/assets/admin/img/900x400/img2.jpg')  ); ?>
                            <td>

                                <div class="pl-2"><?php echo e($cu->id); ?></div>
                            </td>
                            <td>
                            <span class="d-block font-size-sm text-body pl-2">
                                <?php echo e(Str::limit($cu['name'], 20,'...')); ?>

                            </span>
                            </td>
                            <td>
                                <div class="text-center"> <?php echo e($cu->restaurants_count); ?></div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <label class="toggle-switch toggle-switch-sm" for="stocksCheckbox<?php echo e($cu->id); ?>">
                                    <input type="checkbox" data-url="<?php echo e(route('admin.cuisine.status',[$cu['id'],$cu->status?0:1])); ?>" class="toggle-switch-input redirect-url" id="stocksCheckbox<?php echo e($cu->id); ?>" <?php echo e($cu->status?'checked':''); ?>>
                                        <span class="toggle-switch-label">
                                            <span class="toggle-switch-indicator"></span>
                                        </span>
                                    </label>
                                </div>
                            </td>

                            <td>
                                <div class="btn--container justify-content-center">
                                    <a class="btn btn-sm btn--primary btn-outline-primary action-btn edit-cuisine"
                                    title="<?php echo e(translate('messages.edit')); ?>" data-id="<?php echo e($cu['id']); ?>"
                                     data-toggle="modal"   data-target="#add_update_cuisine_<?php echo e($cu->id); ?>"
                                    ><i class="tio-edit"></i>
                                    </a>
                                    <a class="btn btn-sm btn--danger btn-outline-danger action-btn form-alert" href="javascript:"
                                    data-id="cuisine-<?php echo e($cu['id']); ?>" data-message="<?php echo e(translate('Want_to_delete_this_cuisine_?')); ?>" title="<?php echo e(translate('messages.delete_cuisine')); ?>"><i class="tio-delete-outlined"></i>
                                    </a>
                                </div>

                                <form action="<?php echo e(route('admin.cuisine.delete',['id' =>$cu['id']])); ?>" method="post" id="cuisine-<?php echo e($cu['id']); ?>">
                                    <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="add_update_cuisine_<?php echo e($cu->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            <?php echo e(translate('messages.Update')); ?></label></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?php echo e(route('admin.cuisine.update',)); ?>" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('put'); ?>
                                            <input type="hidden" name="id" value="<?php echo e($cu->id); ?>" id="id" />

                                        <?php ($cu=  \App\Models\Cuisine::withoutGlobalScope('translate')->with('translations')->find($cu->id)); ?>
                                        <?php ($language=\App\Models\BusinessSetting::where('key','language')->first()); ?>
                                        <?php ($language = $language->value ?? null); ?>
                                        <?php ($default_lang = str_replace('_', '-', app()->getLocale())); ?>
                                        <ul class="nav nav-tabs nav--tabs mb-3 border-0">
                                            <li class="nav-item">
                                                <a class="nav-link update-lang_link add_active active"
                                                href="#"
                                                id="default-link"><?php echo e(translate('Default')); ?></a>
                                            </li>
                                            <?php if($language): ?>
                                            <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="nav-item">
                                                    <a class="nav-link update-lang_link"
                                                        href="#"
                                                    data-cuisine-id="<?php echo e($cu->id); ?>"
                                                        id="<?php echo e($lang); ?>-link"><?php echo e(\App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')'); ?></a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </ul>
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group mb-3 add_active_2  update-lang_form" id="default-form_<?php echo e($cu->id); ?>">
                                                    <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.name')); ?>  (<?php echo e(translate('messages.default')); ?>)</label>
                                                    <input class="form-control" name='name[]' value="<?php echo e($cu->getRawOriginal('name')); ?>"  type="text">
                                                    <input type="hidden" name="lang1[]" value="default">
                                                </div>
                                                <?php if($language): ?>
                                                <?php $__empty_1 = true; $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <?php
                                                    if($cu?->translations){
                                                        $translate = [];
                                                        foreach($cu?->translations as $t)
                                                        {
                                                            if($t->locale == $lang && $t->key=="cuisine_name"){
                                                                $translate[$lang]['cuisine_name'] = $t->value;
                                                            }
                                                        }
                                                    }

                                                    ?>
                                                    <div class="form-group mb-3 d-none update-lang_form" id="<?php echo e($lang); ?>-langform_<?php echo e($cu->id); ?>">
                                                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.name')); ?> (<?php echo e(strtoupper($lang)); ?>) </label>
                                                        <input class="form-control" name='name[]' value="<?php echo e($translate[$lang]['cuisine_name'] ?? null); ?>"  type="text">
                                                        <input type="hidden" name="lang1[]" value="<?php echo e($lang); ?>">
                                                    </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <?php endif; ?>
                                                    <?php endif; ?>

                                            </div>
                                        </div>
                                            <div class="row mt-2">
                                                <div class="col-md-6 col-lg-12">

                                                    




                                                            <div class="form-group mb-0 text-center">
                                                                <label class="form-label d-block mb-2">
                                                                    <?php echo e(translate('Image')); ?>  <span class="text--primary">(1:1)</span>
                                                                </label>
                                                                <label class="upload-img-3 m-0 d-block my-auto">
                                                                    <div class="img">
                                                                        <img data-onerror-image="<?php echo e(dynamicAsset('/public/assets/admin/img/upload-6.png')); ?>" src="<?php echo e(\App\CentralLogics\Helpers::onerror_image_helper($cu['image'], dynamicStorage('storage/app/public/cuisine/').'/'.$cu['image'], dynamicAsset('/public/assets/admin/img/upload-6.png'), 'cuisine/')); ?>"
                                                                        class="vertical-img max-w-187px onerror-image viewer" alt="">
                                                                    </div>
                                                                    <input type="file"  name="image" hidden="">
                                                                </label>
                                                            </div>





                                                </div>
                                            </div>
                                        <div class="col-12">
                                            <div class="form-group pt-2 mb-0">
                                                <div class="btn--container justify-content-end mt-3">
                                                    <!-- Static Button -->
                                                    <button
                                                    data-image-src="<?php echo e(\App\CentralLogics\Helpers::onerror_image_helper($cu['image'], dynamicStorage('storage/app/public/cuisine/').'/'.$cu['image'], dynamicAsset('/public/assets/admin/img/upload-6.png'), 'cuisine/')); ?>"
                                                    type="reset" aria-label="Close" class="btn btn--reset reset-btn"><?php echo e(translate('messages.reset')); ?></button>
                                                    <!-- Static Button -->
                                                    <button type="submit" class="btn btn--primary"><?php echo e(translate('messages.submit')); ?></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php if(count($cuisine) === 0): ?>
                <div class="empty--data">
                    <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/empty.png')); ?>" alt="public">
                    <h5>
                        <?php echo e(translate('no_data_found')); ?>

                    </h5>
                </div>
                <?php endif; ?>
            </div>
            <div class="card-footer pt-0 border-0">
                <div class="page-area px-4 pb-3">
                    <div class="d-flex align-items-center justify-content-end">
                        <div>
                            <?php echo $cuisine->links(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add_new_cuisine">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="<?php echo e(route('admin.cuisine.store')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php ($language=\App\Models\BusinessSetting::where('key','language')->first()); ?>
                        <?php ($language = $language->value ?? null); ?>
                        <?php ($default_lang = str_replace('_', '-', app()->getLocale())); ?>
                        <?php if($language): ?>
                        <ul class="nav nav-tabs nav--tabs mb-3 border-0">
                            <li class="nav-item">
                                <a class="nav-link lang_link1 active"
                                href="#"
                                id="default-link1"><?php echo e(translate('Default')); ?></a>
                            </li>
                            <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item">
                                    <a class="nav-link lang_link1"
                                        href="#"
                                        id="<?php echo e($lang); ?>-link1"><?php echo e(\App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')'); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <?php endif; ?>
                        <div class="row">
                            <div  id="output1"  class="col-md-12 col-lg-12">
                                <div class="form-group mb-3 lang_form1 default-form1">
                                    <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.name')); ?>  (<?php echo e(translate('messages.default')); ?>)</label>
                                    <input type="text" name="name[]" class="form-control" placeholder="<?php echo e(translate('New_cuisine')); ?>" >
                                </div>
                                <input type="hidden" name="lang[]" value="default">
                                <?php if($language): ?>
                                <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="form-group mb-3 d-none lang_form1" id="<?php echo e($lang); ?>-form1">
                                    <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.name')); ?> (<?php echo e(strtoupper($lang)); ?>)</label>
                                    <input type="text" name="name[]" class="form-control" placeholder="<?php echo e(translate('New_cuisine')); ?>" >
                                </div>
                                <input type="hidden" name="lang[]" value="<?php echo e($lang); ?>">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                            <div class="row mt-2">
                                <div class="col-md-6 col-lg-12">

                                    <div class="d-flex flex-column align-items-center gap-3">
                                        <p class="mb-0"><?php echo e(translate('Cuisine image')); ?></p>

                                        <div class="image-box">
                                            <label for="image-input2" class="d-flex flex-column align-items-center justify-content-center h-100 cursor-pointer gap-2">
                                            <img width="30"  class="upload-icon" src="<?php echo e(asset('public/assets/admin/img/upload-icon.png')); ?>" alt="Upload Icon">
                                            <span class="upload-text"><?php echo e(translate('Upload Image')); ?></span>
                                            <img src="#" alt="Preview Image" class="preview-image image_on_add">
                                            </label>
                                            <button type="button" class="delete_image">
                                            <i class="tio-delete"></i>
                                            </button>
                                            <input type="file" id="image-input2" name="image" accept="image/*" hidden>
                                        </div>

                                        <p class="opacity-75 max-w220 mx-auto text-center">
                                            <?php echo e(translate('Image format - jpg png jpeg gif Image Size -maximum size 2 MB Image Ratio - 1:1')); ?>

                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group pt-2 mb-0">
                                    <div class="btn--container justify-content-end mt-3">
                                        <!-- Static Button -->
                                        <button id="reset_btn1"  aria-label="Close" type="reset" class="btn btn--reset"><?php echo e(translate('messages.reset')); ?></button>
                                        <!-- Static Button -->
                                        <button type="submit" class="btn btn--primary"><?php echo e(translate('messages.submit')); ?></button>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
<script src="<?php echo e(dynamicAsset('public/assets/admin/js/view-pages/cuisine.js')); ?>"></script>
<script>

    "use strict";
    // $('.reset-btn').on('click',function (){
    //     let image = $(this).data('image-src')
    //     $('#name').val(null);
    //     $('.preview-image').attr('src', image);
    //     $('#image').val(null);
    // });


    "use strict";
    $('.reset-btn').on('click',function (){
        let image = $(this).data('image-src')
        $('#name').val(null);
        $('.viewer').attr('src', image);
        $('#image').val(null);
    });
    $('#reset_btn1').on('click',function (){
        $('#name').val(null);
            $('.image_on_add').attr('src', "<?php echo e(dynamicAsset('/public/assets/admin/img/upload-6.png')); ?>");
            $('#image').val(null);
    });


</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/cuisine/index.blade.php ENDPATH**/ ?>