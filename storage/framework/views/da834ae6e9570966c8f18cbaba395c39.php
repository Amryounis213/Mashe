<?php $__env->startSection('title',translate('messages.Add_New_Category')); ?>

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
                            <img src="<?php echo e(dynamicAsset('public/assets/admin/img/category.png')); ?>" alt="">
                        </div>
                        <span>
                            <?php echo e(translate('Category')); ?>

                        </span>
                    </h2>
                </div>
                <?php if(isset($category)): ?>
                <a href="<?php echo e(route('admin.category.add')); ?>" class="btn btn--primary pull-right"><i class="tio-add-circle"></i> <?php echo e(translate('messages.Add_New_Category')); ?></a>
                <?php endif; ?>
            </div>
        </div>
        <!-- End Page Header -->

        <div class="card resturant--cate-form">
            <div class="card-body">
                <form action="<?php echo e(isset($category)?route('admin.category.update',[$category['id']]):route('admin.category.store')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php ($language=\App\Models\BusinessSetting::where('key','language')->first()); ?>
                    <?php ($language = $language->value ?? null); ?>
                    <?php ($default_lang = str_replace('_', '-', app()->getLocale())); ?>
                    <?php if($language): ?>
                        <ul class="nav nav-tabs mb-4">
                            <li class="nav-item">
                                <a class="nav-link lang_link  active" href="#" id="default-link"><?php echo e(translate('Default')); ?></a>
                            </li>
                            <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="nav-item">
                                    <a class="nav-link lang_link " href="#" id="<?php echo e($lang); ?>-link"><?php echo e(\App\CentralLogics\Helpers::get_language_name($lang).'('.strtoupper($lang).')'); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
                    <input name="position" value="0" type="hidden">

                    <div class="row">
                        <div class="col-lg-6">
                            <?php if($language): ?>
                            <div class="form-group lang_form" id="default-form">
                                    <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.name')); ?></label>
                                    <input type="text" name="name[]" class="form-control" placeholder="<?php echo e(translate('Ex:_Category_Name')); ?>"   maxlength="191">
                                <input type="hidden" name="lang[]" value="default">
                            </div>
                                <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-group d-none lang_form" id="<?php echo e($lang); ?>-form">
                                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.name')); ?> (<?php echo e(strtoupper($lang)); ?>)</label>
                                        <input id="name" type="text" name="name[]" class="form-control" placeholder="<?php echo e(translate('Ex:_Category_Name')); ?>" maxlength="191"  >
                                        <input type="hidden" name="lang[]" value="<?php echo e($lang); ?>">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.name')); ?></label>
                                    <input type="text" name="name[]" class="form-control" placeholder="<?php echo e(translate('Ex:_Category_Name')); ?>"   maxlength="191">
                                </div>
                                <input type="hidden" name="lang[]" value="default">
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex flex-column align-items-center gap-3">
                                <p class="mb-0"><?php echo e(translate('Category image')); ?></p>

                                <div class="image-box">
                                    <label for="image-input" class="d-flex flex-column align-items-center justify-content-center h-100 cursor-pointer gap-2">
                                        <img class="upload-icon initial-10"
                                        src="<?php echo e(dynamicAsset('public/assets/admin/img/upload-icon.png')); ?>" alt="Upload Icon">
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

                        <div class="col-12">
                            <div class="form-group pt-2 mb-0">
                                <div class="btn--container justify-content-end">
                                    <!-- Static Button -->
                                    <button id="reset_btn" type="reset" class="btn btn--reset"><?php echo e(translate('messages.reset')); ?></button>
                                    <!-- Static Button -->
                                    <button type="submit" class="btn btn--primary"><?php echo e(isset($category)?translate('messages.update'):translate('messages.submit')); ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header py-2">
                <div class="search--button-wrapper">
                    <h5 class="card-title"><span class="card-header-icon">
                        <i class="tio-category-outlined"></i>
                    </span> <?php echo e(translate('messages.category_list')); ?><span class="badge badge-soft-dark ml-2" id="itemCount"><?php echo e($categories->total()); ?></span></h5>
                    <form>

                        <!-- Search -->
                        <div class="input--group input-group input-group-merge input-group-flush">
                            <input type="search" name="search" value="<?php echo e(request()?->search ?? null); ?>"  class="form-control" placeholder="<?php echo e(translate('Ex_:_Categories')); ?>" aria-label="<?php echo e(translate('messages.search_categories')); ?>">
                            <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>
                        </div>
                        <!-- End Search -->
                    </form>

                    <div class="hs-unfold ml-3">
                        <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle btn export-btn btn-outline-primary btn--primary font--sm" href="javascript:;"
                            data-hs-unfold-options='{
                                "target": "#usersExportDropdown",
                                "type": "css-animation"
                            }'>
                            <i class="tio-download-to mr-1"></i> <?php echo e(translate('messages.export')); ?>

                        </a>

                        <div id="usersExportDropdown"
                                class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">
                            <span class="dropdown-header"><?php echo e(translate('messages.download_options')); ?></span>
                            <a target="__blank" id="export-excel" class="dropdown-item" href="<?php echo e(route('admin.category.export-categories', ['type'=>'excel', request()->getQueryString()])); ?>">
                                <img class="avatar avatar-xss avatar-4by3 mr-2"
                                        src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/svg/components/excel.svg"
                                        alt="Image Description">
                                <?php echo e(translate('messages.excel')); ?>

                            </a>
                            <a target="__blank" id="export-csv" class="dropdown-item" href="<?php echo e(route('admin.category.export-categories', ['type'=>'csv', request()->getQueryString()])); ?>">
                                <img class="avatar avatar-xss avatar-4by3 mr-2"
                                        src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/svg/components/placeholder-csv-format.svg"
                                        alt="Image Description">
                                <?php echo e(translate('messages.csv')); ?>

                            </a>
                        </div>
                    </div>
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
                            <th><?php echo e(translate('messages.SL')); ?></th>
                            <th><?php echo e(translate('messages.image')); ?></th>
                            <th><?php echo e(translate('messages.name')); ?></th>
                            <th>
                                <div class="ml-3">
                                    <?php echo e(translate('messages.priority')); ?>

                                </div>
                            </th>
                            <th><?php echo e(translate('messages.status')); ?></th>
                            <th class="text-cetner w-130px"><?php echo e(translate('messages.action')); ?></th>
                        </tr>
                    </thead>

                    <tbody id="table-div">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <div class="pl-3">
                                    <?php echo e($key+$categories->firstItem()); ?>

                                </div>
                            </td>
                            <td>
                                <div class="">
                                    <img class="avatar border"

                                    src="<?php echo e(\App\CentralLogics\Helpers::onerror_image_helper($category['image'], dynamicStorage('storage/app/public/category/').'/'.$category['image'], dynamicAsset('/public/assets/admin/img/900x400/img1.jpg'), 'category/')); ?>"


                                  alt="<?php echo e(Str::limit($category['name'], 20,'...')); ?>">
                                </div>
                            </td>
                            <td>
                                <div class="d-block font-size-sm text-body">
                                    <div><?php echo e(Str::limit($category['name'], 20,'...')); ?></div>
                                    <div class="font-weight-bold"><?php echo e(translate('ID')); ?> #<?php echo e($category->id); ?></div>
                                </div>
                            </td>
                            <td>
                                <form action="<?php echo e(route('admin.category.priority',$category->id)); ?>" class="priority-form">
                                <select name="priority" id="priority" class=" form-control form--control-select priority-select <?php echo e($category->priority == 0 ? 'text--title':''); ?> <?php echo e($category->priority == 1 ? 'text--info':''); ?> <?php echo e($category->priority == 2 ? 'text--success':''); ?> ">
                                    <option class="text--title" value="0" <?php echo e($category->priority == 0?'selected':''); ?>><?php echo e(translate('messages.normal')); ?></option>
                                    <option class="text--info" value="1" <?php echo e($category->priority == 1?'selected':''); ?>><?php echo e(translate('messages.medium')); ?></option>
                                    <option class="text--success" value="2" <?php echo e($category->priority == 2?'selected':''); ?>><?php echo e(translate('messages.high')); ?></option>
                                </select>
                                </form>
                            </td>
                            <td>
                                <label class="toggle-switch toggle-switch-sm ml-2" for="stocksCheckbox<?php echo e($category->id); ?>">
                                <input type="checkbox" data-url="<?php echo e(route('admin.category.status',[$category['id'],$category->status?0:1])); ?>" class="toggle-switch-input redirect-url" id="stocksCheckbox<?php echo e($category->id); ?>" <?php echo e($category->status?'checked':''); ?>>
                                    <span class="toggle-switch-label">
                                        <span class="toggle-switch-indicator"></span>
                                    </span>
                                </label>
                            </td>
                            <td>
                                <div class="btn--container">
                                    <a class="btn btn-sm btn--primary btn-outline-primary action-btn"
                                        href="<?php echo e(route('admin.category.edit',[$category['id']])); ?>" title="<?php echo e(translate('messages.edit_category')); ?>"><i class="tio-edit"></i>
                                    </a>
                                    <a class="btn btn-sm btn--danger btn-outline-danger action-btn form-alert" href="javascript:"
                                    data-id="category-<?php echo e($category['id']); ?>" data-message="<?php echo e(translate('Want_to_delete_this_category_?')); ?>" title="<?php echo e(translate('messages.delete_category')); ?>"><i class="tio-delete-outlined"></i>
                                    </a>
                                </div>

                                <form action="<?php echo e(route('admin.category.delete',[$category['id']])); ?>" method="post" id="category-<?php echo e($category['id']); ?>">
                                    <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php if(count($categories) === 0): ?>
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
                            <?php echo $categories->links(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/js/view-pages/category-index.js"></script>
    <script>
        "use strict";
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg1").change(function () {
            readURL(this);
        });
        $('#reset_btn').on('click',function (){

            $('.preview-image').attr('src', "<?php echo e(dynamicAsset('public/assets/admin/img/aspect-1.png')); ?>");
            $('#image').val(null);
    });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/category/index.blade.php ENDPATH**/ ?>