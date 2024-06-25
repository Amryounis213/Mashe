<?php $__env->startSection('title',translate('Add_New_Coupon')); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i class="tio-add-circle-outlined"></i> <?php echo e(translate('messages.Add_New_Coupon')); ?></h1>
                </div>
            </div>
        </div>
        <?php ($language=\App\Models\BusinessSetting::where('key','language')->first()); ?>
        <?php ($language = $language->value ?? null); ?>
        <?php ($default_lang = str_replace('_', '-', app()->getLocale())); ?>
        <!-- End Page Header -->
        <div class="card mb-3">
            <div class="card-body">
                <form action="<?php echo e(route('admin.coupon.store')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-12">
                            <?php if($language): ?>
                            <ul class="nav nav-tabs mb-3 border-0">
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
                            <div class="lang_form" id="default-form">
                                <div class="form-group">
                                    <label class="input-label"
                                        for="default_title"><?php echo e(translate('messages.title')); ?> (<?php echo e(translate('messages.Default')); ?>)
                                    </label>
                                    <input type="text" name="title[]" id="default_title"
                                        class="form-control" placeholder="<?php echo e(translate('messages.new_coupon')); ?>"

                                         >
                                </div>
                                <input type="hidden" name="lang[]" value="default">
                            </div>
                                <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="d-none lang_form"
                                        id="<?php echo e($lang); ?>-form">
                                        <div class="form-group">
                                            <label class="input-label"
                                                for="<?php echo e($lang); ?>_title"><?php echo e(translate('messages.title')); ?>

                                                (<?php echo e(strtoupper($lang)); ?>)
                                            </label>
                                            <input type="text" name="title[]" id="<?php echo e($lang); ?>_title"
                                                class="form-control" placeholder="<?php echo e(translate('messages.new_coupon')); ?>"
                                                 >
                                        </div>
                                        <input type="hidden" name="lang[]" value="<?php echo e($lang); ?>">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <div id="default-form">
                                    <div class="form-group">
                                        <label class="input-label"
                                            for="exampleFormControlInput1"><?php echo e(translate('messages.title')); ?> (<?php echo e(translate('messages.default')); ?>)</label>
                                        <input type="text" name="title[]" class="form-control"
                                            placeholder="<?php echo e(translate('messages.new_coupon')); ?>" >
                                    </div>
                                    <input type="hidden" name="lang[]" value="default">
                                </div>
                            <?php endif; ?>




                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.coupon_type')); ?></label>
                                <select id="coupon_type" name="coupon_type" class="form-control">
                                    <option value="restaurant_wise"><?php echo e(translate('messages.restaurant_wise')); ?></option>
                                    <option value="zone_wise"><?php echo e(translate('messages.zone_wise')); ?></option>
                                    <option value="free_delivery"><?php echo e(translate('messages.free_delivery')); ?></option>
                                    <option value="first_order"><?php echo e(translate('messages.first_order')); ?></option>
                                    <option value="default"><?php echo e(translate('messages.default')); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-lg-3 col-sm-6" id="restaurant_wise">
                            <label class="input-label" for="exampleFormControlSelect1"><?php echo e(translate('messages.restaurant')); ?><span
                                    class="input-label-secondary"></span></label>
                            <select id="select_restaurant" name="restaurant_ids[]" class="js-data-example-ajax form-control" data-placeholder="<?php echo e(translate('messages.select_restaurant')); ?>" title="<?php echo e(translate('messages.select_restaurant')); ?>">
                            </select>
                        </div>

                        <div class="form-group col-lg-3 col-sm-6" id="customer_wise">
                            <label class="input-label" for="select_customer"><?php echo e(translate('messages.select_customer')); ?></label>
                            <select name="customer_ids[]" id="select_customer"
                                class="form-control js-select2-custom"
                                multiple="multiple" data-placeholder="<?php echo e(translate('messages.select_customer')); ?>">
                                <option value="all"><?php echo e(translate('messages.all')); ?> </option>
                            <?php $__currentLoopData = \App\Models\User::get(['id','f_name','l_name']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($user->id); ?>"><?php echo e($user->f_name.' '.$user->l_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>



                        <div class="form-group col-lg-3 col-sm-6" id="zone_wise">
                            <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.select_zone')); ?></label>
                            <select name="zone_ids[]" id="choice_zones"
                                class="form-control js-select2-custom"
                                multiple="multiple" data-placeholder="<?php echo e(translate('messages.select_zone')); ?>">
                            <?php $__currentLoopData = \App\Models\Zone::where('status',1)->get(['id','name']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($zone->id); ?>"><?php echo e($zone->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.code')); ?></label>
                                <input id="coupon_code" type="text" name="code" class="form-control"
                                    placeholder="<?php echo e(\Illuminate\Support\Str::random(8)); ?>" required maxlength="100">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.limit_for_same_user')); ?></label>
                                <input type="number" name="limit" id="coupon_limit" class="form-control" placeholder="<?php echo e(translate('messages.Ex:_10')); ?>" max="100">
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.start_date')); ?></label>
                                <input type="date" name="start_date" class="form-control" id="date_from" required>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.expire_date')); ?></label>
                                <input type="date" name="expire_date" class="form-control" id="date_to" required>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.discount_type')); ?></label>
                                <select name="discount_type" required class="form-control" id="discount_type">
                                    <option value="amount">
                                            <?php echo e(translate('messages.amount').' ('.\App\CentralLogics\Helpers::currency_symbol().')'); ?>

                                    </option>
                                    <option value="percent"> <?php echo e(translate('messages.percent').' (%)'); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.discount')); ?>

                            </label>
                                <input type="number" step="0.01" min="1" max="999999999999.99" name="discount" id="discount" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group">
                                <label class="input-label" for="max_discount"><?php echo e(translate('messages.max_discount')); ?></label>
                                <input type="number" step="0.01" min="0" value="0" max="999999999999.99" name="max_discount" id="max_discount" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.min_purchase')); ?></label>
                                <input id="min_purchase" type="number" step="0.01" name="min_purchase" value="0" min="0" max="999999999999.99" class="form-control"
                                    placeholder="100">
                            </div>
                        </div>
                    </div>
                    <div class="btn--container justify-content-end">
                        <button id="reset_btn" type="button" class="btn btn--reset"><?php echo e(translate('messages.reset')); ?></button>
                        <button type="submit" class="btn btn--primary"><?php echo e(translate('messages.submit')); ?></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header py-2">
                <div class="search--button-wrapper">
                    <h5 class="card-title"><?php echo e(translate('messages.coupon_list')); ?><span class="badge badge-soft-dark ml-2" id="itemCount"><?php echo e($coupons->total()); ?></span></h5>
                    <form method="get" >
                        <!-- Search -->
                        <div class="input--group input-group input-group-merge input-group-flush">
                            <input id="datatableSearch" type="search" value="<?php echo e(request()?->search ?? null); ?>"  name="search" class="form-control" placeholder="<?php echo e(translate('messages.Ex:_Search_by_title_or_code')); ?>" aria-label="<?php echo e(translate('messages.search_here')); ?>">
                            <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>
                        </div>
                        <!-- End Search -->
                    </form>

                    <div class="hs-unfold mr-2">
                        <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle min-height-40" href="javascript:;"
                            data-hs-unfold-options='{
                                    "target": "#usersExportDropdown",
                                    "type": "css-animation"
                                }'>
                            <i class="tio-download-to mr-1"></i> <?php echo e(translate('messages.export')); ?>

                        </a>

                        <div id="usersExportDropdown"
                            class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">

                            <span class="dropdown-header"><?php echo e(translate('messages.download_options')); ?></span>
                            <a id="export-excel" class="dropdown-item" href="
                            <?php echo e(route('admin.coupon.coupon_export', ['type' => 'excel', request()->getQueryString()])); ?>

                                ">
                                <img class="avatar avatar-xss avatar-4by3 mr-2"
                                    src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/svg/components/excel.svg"
                                    alt="Image Description">
                                <?php echo e(translate('messages.excel')); ?>

                            </a>
                            <a id="export-csv" class="dropdown-item" href="
                            <?php echo e(route('admin.coupon.coupon_export', ['type' => 'csv', request()->getQueryString()])); ?>">
                                <img class="avatar avatar-xss avatar-4by3 mr-2"
                                    src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/svg/components/placeholder-csv-format.svg"
                                    alt="Image Description">
                                <?php echo e(translate('messages.csv')); ?>

                            </a>
                        </div>
                    </div>


                </div>
            </div>
            <!-- Table -->
            <div class="table-responsive datatable-custom" id="table-div">
                <table id="columnSearchDatatable"
                        class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                        data-hs-datatables-options='{
                        "order": [],
                        "orderCellsTop": true,

                        "entries": "#datatableEntries",
                        "isResponsive": false,
                        "isShowPaging": false,
                        "paging":false,
                        }'>
                    <thead class="thead-light">
                    <tr>
                        <th><?php echo e(translate('messages.sl')); ?></th>
                        <th><?php echo e(translate('messages.title')); ?></th>
                        <th><?php echo e(translate('messages.code')); ?></th>
                        <th><?php echo e(translate('messages.type')); ?></th>
                        <th><?php echo e(translate('messages.total_uses')); ?></th>
                        <th><?php echo e(translate('messages.min_purchase')); ?></th>
                        <th><?php echo e(translate('messages.max_discount')); ?></th>
                        <th>
                            <div class="text-center">
                                <?php echo e(translate('messages.discount')); ?>

                            </div>
                        </th>
                        <th><?php echo e(translate('messages.discount_type')); ?></th>
                        <th><?php echo e(translate('messages.start_date')); ?></th>
                        <th><?php echo e(translate('messages.expire_date')); ?></th>
                        <th><?php echo e(translate('messages.Customer_type')); ?></th>
                        <th><?php echo e(translate('messages.status')); ?></th>
                        <th class="text-center"><?php echo e(translate('messages.action')); ?></th>
                    </tr>
                    </thead>

                    <tbody id="set-rows">
                    <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($key+$coupons->firstItem()); ?></td>
                            <td>
                            <span class="d-block font-size-sm text-body">
                                <?php echo e(Str::limit($coupon['title'],15,'...')); ?>

                            </span>
                            </td>
                            <td><?php echo e($coupon['code']); ?></td>
                            <td><?php echo e(translate('messages.'.$coupon->coupon_type)); ?></td>
                            <td><?php echo e($coupon->total_uses); ?></td>
                            <td>
                                <div class="text-right mw-87px">
                                    <?php echo e(\App\CentralLogics\Helpers::format_currency($coupon['min_purchase'])); ?>

                                </div>
                            </td>
                            <td>
                                <div class="text-right mw-87px">
                                    <?php echo e(\App\CentralLogics\Helpers::format_currency($coupon['max_discount'])); ?>

                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <?php echo e($coupon['discount']); ?>

                                </div>
                            </td>
                            <?php if($coupon['discount_type'] == 'percent'): ?>
                            <td><?php echo e(translate('messages.percent')); ?></td>
                            <?php elseif($coupon['discount_type'] == 'amount'): ?>
                            <td><?php echo e(translate('messages.amount')); ?></td>
                            <?php else: ?>
                            <td><?php echo e($coupon['discount_type'] == ''? '--':$coupon['discount_type']); ?></td>
                            <?php endif; ?>

                            <td><?php echo e($coupon['start_date']); ?></td>
                            <td><?php echo e($coupon['expire_date']); ?></td>

                            <td>
                                <span class="d-block font-size-sm text-body">
                                    <?php if(in_array('all', json_decode($coupon->customer_id))): ?>
                                    <?php echo e(translate('messages.all_customers')); ?>

                                    <?php else: ?>
                                    <?php echo e(translate('messages.Selected_customers')); ?>

                                    <?php endif; ?>
                                </span>
                            </td>
                            <td>
                                <label class="toggle-switch toggle-switch-sm" for="couponCheckbox<?php echo e($coupon->id); ?>">
                                    <input type="checkbox" data-url="<?php echo e(route('admin.coupon.status',[$coupon['id'],$coupon->status?0:1])); ?>" class="toggle-switch-input redirect-url" id="couponCheckbox<?php echo e($coupon->id); ?>" <?php echo e($coupon->status?'checked':''); ?>>
                                    <span class="toggle-switch-label">
                                                <span class="toggle-switch-indicator"></span>
                                            </span>
                                </label>
                            </td>
                            <td>
                                <div class="btn--container justify-content-center">
                                    <a class="btn btn-sm btn--primary btn-outline-primary action-btn" href="<?php echo e(route('admin.coupon.update',[$coupon['id']])); ?>"title="<?php echo e(translate('messages.edit_coupon')); ?>"><i class="tio-edit"></i>
                                    </a>
                                    <a class="btn btn-sm btn--danger btn-outline-danger action-btn form-alert" href="javascript:" data-id="coupon-<?php echo e($coupon['id']); ?>" data-message="<?php echo e(translate('Want to delete this coupon ?')); ?>" title="<?php echo e(translate('messages.delete_coupon')); ?>"><i class="tio-delete-outlined"></i>
                                    </a>
                                    <form action="<?php echo e(route('admin.coupon.delete',[$coupon['id']])); ?>"
                                    method="post" id="coupon-<?php echo e($coupon['id']); ?>">
                                    <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php if(count($coupons) === 0): ?>
                <div class="empty--data">
                    <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/empty.png')); ?>" alt="public">
                    <h5>
                        <?php echo e(translate('no_data_found')); ?>

                    </h5>
                </div>
                <?php endif; ?>
                <div class="page-area px-4 pb-3">
                    <div class="d-flex align-items-center justify-content-end">
                        <div>
                            <?php echo $coupons->links(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Table -->
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/js/view-pages/coupon-index.js"></script>
    <script>
        "use strict";

        $(document).on('ready', function () {
            $('.js-data-example-ajax').select2({
                ajax: {
                    url: '<?php echo e(url('/')); ?>/admin/restaurant/get-restaurants',
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    __port: function (params, success, failure) {
                        let $request = $.ajax(params);

                        $request.then(success);
                        $request.fail(failure);

                        return $request;
                    }
                }
            });
            // INITIALIZATION OF DATATABLES
            // =======================================================
            let datatable = $.HSCore.components.HSDatatables.init($('#columnSearchDatatable'), {
                select: {
                    style: 'multi',
                    classMap: {
                        checkAll: '#datatableCheckAll',
                        counter: '#datatableCounter',
                        counterInfo: '#datatableCounterInfo'
                    }
                },
                language: {
                    zeroRecords: '<div class="text-center p-4">' +
                        '<img class="w-7rem mb-3" src="<?php echo e(dynamicAsset('public/assets/admin/svg/illustrations/sorry.svg')); ?>" alt="Image Description">' +
                        '<p class="mb-0"><?php echo e(translate('No_data_to_show')); ?></p>' +
                        '</div>'
                }
            });
        });

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/coupon/index.blade.php ENDPATH**/ ?>