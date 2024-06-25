<?php $__env->startSection('title',translate('messages.Custom_Role')); ?>
<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">

    <!-- Page Heading -->
    <div class="page-header">
        <h1 class="page-header-title mb-2 text-capitalize">
            <div class="card-header-icon d-inline-flex mr-2 img">
                <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/role.png')); ?>" alt="public">
            </div>
            <span>
                <?php echo e(translate('messages.Employee_Role')); ?>

            </span>
        </h1>
    </div>
    <!-- Content Row -->
    <div class="card mb-3">
        <div class="card-body">
            <form action="<?php echo e(route('admin.custom-role.create')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-6">
                        <?php ($language=\App\Models\BusinessSetting::where('key','language')->first()); ?>
                        <?php ($language = $language->value ?? null); ?>
                        <?php ($default_lang = str_replace('_', '-', app()->getLocale())); ?>
                        <?php if($language): ?>
                        <ul class="nav nav-tabs mb-4">
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
                        <input type="hidden" name="lang[]" value="default">

                        <div class="form-group lang_form" id="default-form">
                            <label class="form-label input-label " for="name"><?php echo e(translate('messages.role_name')); ?> (<?php echo e(translate('messages.default')); ?>)</label>
                            <input type="text" name="name[]" class="form-control" placeholder="<?php echo e(translate('role_name_example')); ?>" maxlength="191"   >
                        </div>

                        <?php if($language): ?>
                            <?php $__currentLoopData = json_decode($language); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="form-group d-none lang_form" id="<?php echo e($lang); ?>-form">
                                    <label class="input-label" for="exampleFormControlInput1"><?php echo e(translate('messages.role_name')); ?> (<?php echo e(strtoupper($lang)); ?>)</label>
                                    <input type="text" name="name[]" class="form-control" placeholder="<?php echo e(translate('role_name_example')); ?>" maxlength="191"  >
                                </div>
                                <input type="hidden" name="lang[]" value="<?php echo e($lang); ?>">
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="d-flex">
                    <h5 class="input-label m-0 text-capitalize"><?php echo e(translate('messages.module_permission')); ?> : </h5>
                    <div class="check-item pb-0 w-auto">
                        <div class="form-group form-check form--check m-0 ml-2">
                            <input type="checkbox" name="modules[]" value="account" class="form-check-input"
                                    id="select-all">
                            <label class="form-check-label ml-2" for="select-all"><?php echo e(translate('Select_All')); ?></label>
                        </div>
                    </div>
                </div>
                <div class="check--item-wrapper">
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="account" class="form-check-input"
                                    id="account">
                            <label class="form-check-label ml-2 ml-sm-3  text-dark" for="account"><?php echo e(translate('messages.collect_cash')); ?></label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="addon" class="form-check-input"
                                    id="addon">
                            <label class="form-check-label ml-2 ml-sm-3  text-dark" for="addon"><?php echo e(translate('messages.addon')); ?></label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="banner" class="form-check-input"
                                    id="banner">
                            <label class="form-check-label ml-2 ml-sm-3  text-dark" for="banner"><?php echo e(translate('messages.banner')); ?></label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="campaign" class="form-check-input"
                                    id="campaign">
                            <label class="form-check-label ml-2 ml-sm-3  text-dark" for="campaign"><?php echo e(translate('messages.campaign')); ?></label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="category" class="form-check-input"
                                    id="category">
                            <label class="form-check-label ml-2 ml-sm-3  text-dark" for="category"><?php echo e(translate('messages.category')); ?></label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="coupon" class="form-check-input"
                                    id="coupon">
                            <label class="form-check-label ml-2 ml-sm-3  text-dark" for="coupon"><?php echo e(translate('messages.coupon')); ?></label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="customerList" class="form-check-input"
                                    id="customerList">
                            <label class="form-check-label ml-2 ml-sm-3  text-dark" for="customerList"><?php echo e(translate('messages.customers_section')); ?></label>
                        </div>
                    </div>

                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="customer_wallet" class="form-check-input"
                                    id="customer_wallet">
                            <label class="form-check-label ml-2 ml-sm-3  text-dark" for="customer_wallet"><?php echo e(translate('messages.customer_Wallet')); ?></label>
                        </div>
                    </div>

                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="deliveryman" class="form-check-input"
                                    id="deliveryman">
                            <label class="form-check-label ml-2 ml-sm-3  text-dark" for="deliveryman"><?php echo e(translate('messages.deliveryman')); ?></label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="provide_dm_earning" class="form-check-input"
                                    id="provide_dm_earning">
                            <label class="form-check-label ml-2 ml-sm-3  text-dark" for="provide_dm_earning"><?php echo e(translate('messages.deliverymen_earning_provide')); ?></label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="employee" class="form-check-input"
                                    id="employee">
                            <label class="form-check-label ml-2 ml-sm-3  text-dark" for="employee"><?php echo e(translate('messages.Employee')); ?></label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="food" class="form-check-input"
                                    id="food">
                            <label class="form-check-label ml-2 ml-sm-3  text-dark" for="food"><?php echo e(translate('messages.food')); ?></label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="notification" class="form-check-input"
                                    id="notification">
                            <label class="form-check-label ml-2 ml-sm-3  text-dark" for="notification"><?php echo e(translate('messages.push_notification')); ?> </label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="order" class="form-check-input"
                                    id="order">
                            <label class="form-check-label ml-2 ml-sm-3  text-dark" for="order"><?php echo e(translate('messages.order')); ?></label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="restaurant" class="form-check-input"
                                    id="restaurant">
                            <label class="form-check-label ml-2 ml-sm-3  text-dark" for="restaurant"><?php echo e(translate('messages.restaurants')); ?></label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="report" class="form-check-input"
                                    id="report">
                            <label class="form-check-label ml-2 ml-sm-3  text-dark" for="report"><?php echo e(translate('messages.report')); ?></label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="settings" class="form-check-input"
                                    id="settings">
                            <label class="form-check-label ml-2 ml-sm-3  text-dark" for="settings"><?php echo e(translate('messages.business_settings')); ?></label>
                        </div>
                    </div>

                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="withdraw_list" class="form-check-input"
                                    id="withdraw_list">
                            <label class="form-check-label ml-2 ml-sm-3  text-dark" for="withdraw_list"><?php echo e(translate('messages.restaurant_withdraws')); ?></label>
                        </div>
                    </div>

                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="pos" class="form-check-input"
                                    id="pos">
                            <label class="form-check-label ml-2 ml-sm-3  text-dark" for="pos"><?php echo e(translate('messages.pos_system')); ?></label>
                        </div>
                    </div>

                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="zone" class="form-check-input"
                                    id="zone">
                            <label class="form-check-label ml-2 ml-sm-3  text-dark" for="zone"><?php echo e(translate('messages.zone')); ?></label>
                        </div>
                    </div>
                    <div class="check-item">
                        <div class="form-group form-check form--check">
                            <input type="checkbox" name="modules[]" value="contact_message" class="form-check-input"
                                    id="contact_message">
                            <label class="form-check-label ml-2 ml-sm-3  text-dark" for="contact_message"><?php echo e(translate('messages.contact_messages')); ?></label>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pb-3">
                    <div class="btn--container justify-content-end">
                        <button type="reset" id="reset_btn" class="btn btn--reset">
                            <?php echo e(translate('messages.reset')); ?>

                        </button>
                        <button type="submit" class="btn btn--primary"><?php echo e(translate('messages.submit')); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header py-2 border-0">
            <div class="search--button-wrapper">
                <h5 class="card-title">
                    <?php echo e(translate('messages.employee_Role_Table')); ?>

                    <span class="badge badge-soft-dark ml-2" id="itemCount"><?php echo e($rl->total()); ?></span>
                </h5>

                <form action="javascript:" id="search-form">
                    <?php echo csrf_field(); ?>
                    <!-- Search -->
                    <div class="input--group input-group input-group-merge input-group-flush">
                        <input id="datatableSearch_" type="search" name="search" class="form-control" placeholder="<?php echo e(translate('messages.Search_by_Name')); ?>" aria-label="Search">
                        <button type="submit" class="btn btn--secondary">
                            <i class="tio-search"></i>
                        </button>
                    </div>
                    <!-- End Search -->
                </form>

                <div class="hs-unfold ml-3">
                    <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle btn export-btn btn-outline-primary btn--primary font--sm" href="javascript:;"
                        data-hs-unfold-options='{
                            "target": "#usersExportDropdown",
                            "type": "css-animation"
                        }'>
                        <i class="tio-download-to mr-1"></i>
                        <?php echo e(translate('messages.export')); ?>

                    </a>

                    <div id="usersExportDropdown"
                            class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">
                        <span class="dropdown-header"><?php echo e(translate('messages.download_options')); ?></span>
                        <a id="export-excel" class="dropdown-item" href="<?php echo e(route('admin.custom-role.export-employee-role', ['type'=>'excel'])); ?>">
                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                    src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/svg/components/excel.svg"
                                    alt="Image Description">
                            <?php echo e(translate('messages.excel')); ?>

                        </a>
                        <a id="export-csv" class="dropdown-item" href="<?php echo e(route('admin.custom-role.export-employee-role', ['type'=>'excel'])); ?>">
                            <img class="avatar avatar-xss avatar-4by3 mr-2"
                                    src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/svg/components/placeholder-csv-format.svg"
                                    alt="Image Description">
                            <?php echo e(translate('messages.csv')); ?>

                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive datatable-custom">
                <table id="columnSearchDatatable"
                        class="table table-borderless table-thead-bordered table-align-middle card-table"
                        data-hs-datatables-options='{
                            "order": [],
                            "orderCellsTop": true,
                            "paging":false
                        }'>
                    <thead class="thead-light">
                    <tr>
                        <th scope="col" class="w-50px"><?php echo e(translate('messages.sl')); ?></th>
                        <th scope="col" class="w-50px"><?php echo e(translate('Role_Name')); ?></th>
                        <th scope="col" class="w-200px"><?php echo e(translate('messages.modules')); ?></th>
                        <th scope="col" class="w-50px"><?php echo e(translate('messages.created_at')); ?></th>
                        <th scope="col" class="text-center w-50px"><?php echo e(translate('messages.action')); ?></th>
                    </tr>
                    </thead>
                    <tbody  id="set-rows">
                    <?php $__currentLoopData = $rl; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($k+$rl->firstItem()); ?></td>
                            <td><?php echo e(Str::limit($r['name'],25,'...')); ?></td>
                            <td>
                                <div class="text-capitalize" data-toggle="tooltip" data-placement="right" title="<?php if($r['modules']!=null): ?>
                                <?php $__currentLoopData = (array)json_decode($r['modules']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo e(translate(str_replace('_',' ',$m))); ?><?php echo e(!$loop->last ? ',' : '.'); ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>" >
                                    <?php if($r['modules']!=null): ?>
                                        <?php $__currentLoopData = (array)json_decode($r['modules']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e(translate(str_replace('_',' ',$m))); ?><?php echo e(!$loop->last ? ',' : '.'); ?>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <?php echo e(\App\CentralLogics\Helpers::date_format($r['created_at'])); ?>

                            </td>
                            <td>
                                <div class="btn--container justify-content-center">
                                    <a class="btn btn--primary btn-outline-primary action-btn"
                                        href="<?php echo e(route('admin.custom-role.edit',[$r['id']])); ?>" title="<?php echo e(translate('messages.edit_role')); ?>"><i class="tio-edit"></i>
                                    </a>
                                    <a class="btn btn--danger btn-outline-danger action-btn form-alert" href="javascript:"
                                        data-id="role-<?php echo e($r['id']); ?>" data-message="<?php echo e(translate('messages.Want_to_delete_this_role_?')); ?>" title="<?php echo e(translate('messages.delete_role')); ?>"><i class="tio-delete-outlined"></i>
                                    </a>
                                </div>
                                <form action="<?php echo e(route('admin.custom-role.delete',[$r['id']])); ?>"
                                        method="post" id="role-<?php echo e($r['id']); ?>">
                                    <?php echo csrf_field(); ?> <?php echo method_field('delete'); ?>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php if(count($rl) === 0): ?>
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
                <?php echo $rl->links(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script>
        "use strict";
        $('#search-form').on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '<?php echo e(route('admin.custom-role.search')); ?>',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    $('#set-rows').html(data.view);
                    $('#itemCount').html(data.count);
                    $('.page-area').hide();
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        });
        $(document).ready(function() {
            let datatable = $.HSCore.components.HSDatatables.init($('#columnSearchDatatable'));
        });

        $('#reset_btn').click(function(){
            location.reload(true);
        })

    $('#select-all').on('change', function(){
        if(this.checked === true) {
            $('.check--item-wrapper .check-item .form-check-input').attr('checked', true)
        } else {
            $('.check--item-wrapper .check-item .form-check-input').attr('checked', false)
        }
    })

    $('.check--item-wrapper .check-item .form-check-input').on('change', function(){
            if(this.checked === true) {
                $(this).attr('checked', true)
            } else {
                $(this).attr('checked', false)
            }
        })
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/custom-role/create.blade.php ENDPATH**/ ?>