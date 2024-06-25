<?php $__env->startSection('title',translate('messages.Add_New_Country')); ?>

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
                            <img src="<?php echo e(dynamicAsset('public/assets/admin/img/country.png')); ?>" alt="">
                        </div>
                        <span>
                            <?php echo e(translate('Country')); ?>

                        </span>
                    </h2>
                </div>
                <?php if(isset($country)): ?>
                <a href="<?php echo e(route('admin.country.add')); ?>" class="btn btn--primary pull-right"><i class="tio-add-circle"></i> <?php echo e(translate('messages.Add_New_Country')); ?></a>
                <?php endif; ?>
            </div>
        </div>
        <!-- End Page Header -->

        <div class="card resturant--cate-form">
            <div class="card-body">
                <form action="<?php echo e(isset($country)?route('admin.country.update',[$country['id']]):route('admin.country.store')); ?>" method="post" enctype="multipart/form-data">
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
                        <div class="col-lg-12">
                            <?php if($language): ?>
                            <div class="form-group lang_form" id="default-form">
                                    <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.name')); ?></label>
                                    <input type="text" name="name[]" class="form-control" placeholder="<?php echo e(translate('Ex:_Country_Name')); ?>"   maxlength="191">
                                <input type="hidden" name="lang[]" value="default">
                            </div>
                                <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-group d-none lang_form" id="<?php echo e($lang); ?>-form">
                                        <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.name')); ?> (<?php echo e(strtoupper($lang)); ?>)</label>
                                        <input id="name" type="text" name="name[]" class="form-control" placeholder="<?php echo e(translate('Ex:_Country_Name')); ?>" maxlength="191"  >
                                        <input type="hidden" name="lang[]" value="<?php echo e($lang); ?>">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.name')); ?></label>
                                    <input type="text" name="name[]" class="form-control" placeholder="<?php echo e(translate('Ex:_Country_Name')); ?>"   maxlength="191">
                                </div>
                                <input type="hidden" name="lang[]" value="default">
                            <?php endif; ?>
                        </div>
                       

                        <div class="col-12">
                            <div class="form-group pt-2 mb-0">
                                <div class="btn--container justify-content-end">
                                    <!-- Static Button -->
                                    <button id="reset_btn" type="reset" class="btn btn--reset"><?php echo e(translate('messages.reset')); ?></button>
                                    <!-- Static Button -->
                                    <button type="submit" class="btn btn--primary"><?php echo e(isset($country)?translate('messages.update'):translate('messages.submit')); ?></button>
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
                        <i class="tio-country-outlined"></i>
                    </span> <?php echo e(translate('messages.country_list')); ?><span class="badge badge-soft-dark ml-2" id="itemCount"><?php echo e($countries->total()); ?></span></h5>
                    <form>

                        <!-- Search -->
                        <div class="input--group input-group input-group-merge input-group-flush">
                            <input type="search" name="search" value="<?php echo e(request()?->search ?? null); ?>"  class="form-control" placeholder="<?php echo e(translate('Ex_:_countries')); ?>" aria-label="<?php echo e(translate('messages.search_countries')); ?>">
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
                            <a target="__blank" id="export-excel" class="dropdown-item" href="<?php echo e(route('admin.country.export-countries', ['type'=>'excel', request()->getQueryString()])); ?>">
                                <img class="avatar avatar-xss avatar-4by3 mr-2"
                                        src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/svg/components/excel.svg"
                                        alt="Image Description">
                                <?php echo e(translate('messages.excel')); ?>

                            </a>
                            <a target="__blank" id="export-csv" class="dropdown-item" href="<?php echo e(route('admin.country.export-countries', ['type'=>'csv', request()->getQueryString()])); ?>">
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
                            <th><?php echo e(translate('messages.name')); ?></th>
                           
                            <th><?php echo e(translate('messages.status')); ?></th>
                            <th class="text-cetner w-130px"><?php echo e(translate('messages.action')); ?></th>
                        </tr>
                    </thead>

                    <tbody id="table-div">
                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <div class="pl-3">
                                    <?php echo e($key+$countries->firstItem()); ?>

                                </div>
                            </td>
                          
                            <td>
                                <div class="d-block font-size-sm text-body">
                                    <div><?php echo e(Str::limit($country['name'], 20,'...')); ?></div>
                                    <div class="font-weight-bold"><?php echo e(translate('ID')); ?> #<?php echo e($country->id); ?></div>
                                </div>
                            </td>
                           
                            <td>
                                <label class="toggle-switch toggle-switch-sm ml-2" for="stocksCheckbox<?php echo e($country->id); ?>">
                                <input type="checkbox" data-url="<?php echo e(route('admin.country.status',[$country['id'],$country->status?0:1])); ?>" class="toggle-switch-input redirect-url" id="stocksCheckbox<?php echo e($country->id); ?>" <?php echo e($country->status?'checked':''); ?>>
                                    <span class="toggle-switch-label">
                                        <span class="toggle-switch-indicator"></span>
                                    </span>
                                </label>
                            </td>
                            <td>
                                <div class="btn--container">
                                    <a class="btn btn-sm btn--primary btn-outline-primary action-btn"
                                        href="<?php echo e(route('admin.country.edit',[$country['id']])); ?>" title="<?php echo e(translate('messages.edit_country')); ?>"><i class="tio-edit"></i>
                                    </a>
                                    <a class="btn btn-sm btn--danger btn-outline-danger action-btn form-alert" href="javascript:"
                                    data-id="country-<?php echo e($country['id']); ?>" data-message="<?php echo e(translate('Want_to_delete_this_country_?')); ?>" title="<?php echo e(translate('messages.delete_country')); ?>"><i class="tio-delete-outlined"></i>
                                    </a>
                                </div>

                                <form action="<?php echo e(route('admin.country.delete',[$country['id']])); ?>" method="post" id="country-<?php echo e($country['id']); ?>">
                                    <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php if(count($countries) === 0): ?>
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
                            <?php echo $countries->links(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/js/view-pages/country-index.js"></script>
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

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/country/index.blade.php ENDPATH**/ ?>