<?php $__env->startSection('title',translate('messages.Provide_Delivery_Man_Earning')); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                <span class="card-header-icon">
                    <i class="tio-money"></i>
                </span>
                <span>
                    <?php echo e(translate('Provide_Delivery_Man_Earning')); ?>

                </span>
            </h4>
        </div>
        <div class="card-body">
            <form action="<?php echo e(route('admin.provide-deliveryman-earnings.store')); ?>" method='post' id="add_transaction">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-sm-6 col-12">
                        <div class="form-group">
                            <label class="input-label" for="deliveryman"><?php echo e(translate('messages.deliveryman')); ?><span class="input-label-secondary"></span></label>
                            <select id="deliveryman" name="deliveryman_id" data-placeholder="<?php echo e(translate('messages.select_deliveryman')); ?>" data-url="<?php echo e(url('/')); ?>/admin/delivery-man/get-account-data/" data-type="deliveryman" class="form-control account-data" title="Select deliveryman">

                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="form-group">
                            <label class="input-label" for="amount"><?php echo e(translate('messages.amount')); ?><span class="input-label-secondary" id="account_info"></span></label>
                            <input class="form-control h--45px" type="number" min="1" step="0.01" name="amount" id="amount" max="999999999999.99" placeholder="<?php echo e(translate('Ex:_100')); ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 col-12">
                        <div class="form-group">
                            <label class="input-label" for="method"><?php echo e(translate('messages.method')); ?><span class="input-label-secondary"></span></label>
                            <input class="form-control h--45px" type="text" name="method" id="method" required maxlength="191" placeholder="<?php echo e(translate('Ex:_Cash')); ?>">
                        </div>
                    </div>
                    <div class="col-sm-6 col-12">
                        <div class="form-group">
                            <label class="input-label" for="ref"><?php echo e(translate('messages.reference')); ?><span class="input-label-secondary"></span></label>
                            <input  class="form-control h--45px" type="text" name="ref" id="ref" maxlength="191" placeholder="<?php echo e(translate('Ex:_Collect_Cash')); ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group mb-0">
                    <div class="btn--container justify-content-end">
                        <button class="btn btn--reset" type="reset"><?php echo e(translate('messages.reset')); ?></button>
                        <button class="btn btn--primary" type="submit"><?php echo e(translate('messages.save')); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header border-0 py-2">
                    <div class="search--button-wrapper">
                        <h5 class="card-title">
                            <span class="card-header-icon">
                                <i class="tio-file-text-outlined"></i>
                            </span>
                            <span><?php echo e(translate('messages.Distribute_DM_Earning_table')); ?></span>
                        </h5>
                        <!-- Static Search Form -->
                        <form>
                            <div class="input--group input-group">
                                <input name="search" type="search"  value="<?php echo e(request()?->search ?? null); ?>" class="form-control" placeholder="<?php echo e(translate('Ex:_Search_here_by_Name')); ?>">
                                <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>
                            </div>
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
                                <a id="export-excel" class="dropdown-item" href="<?php echo e(route('admin.export-deliveryman-earning',  ['type'=>'excel',request()->getQueryString()])); ?>">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2"
                                            src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/svg/components/excel.svg"
                                            alt="Image Description">
                                    <?php echo e(translate('messages.excel')); ?>

                                </a>
                                <a id="export-csv" class="dropdown-item" href="<?php echo e(route('admin.export-deliveryman-earning', ['type'=>'csv',request()->getQueryString()])); ?>">
                                    <img class="avatar avatar-xss avatar-4by3 mr-2"
                                            src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/svg/components/placeholder-csv-format.svg"
                                            alt="Image Description">
                                    <?php echo e(translate('messages.csv')); ?>

                                </a>

                            </div>
                        </div>
                        <!-- Static Export Button -->
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="datatable"
                            class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                                <tr>
                                    <th><?php echo e(translate('messages.sl')); ?></th>
                                    <th><?php echo e(translate('messages.name')); ?></th>
                                    <th><?php echo e(translate('messages.received_at')); ?></th>
                                    <th><?php echo e(translate('messages.amount')); ?></th>
                                    <th><?php echo e(translate('messages.method')); ?></th>
                                    <th><?php echo e(translate('messages.reference')); ?></th>
                                </tr>
                            </thead>
                            <tbody id="set-rows">
                            <?php $__currentLoopData = $provide_dm_earning; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$at): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td scope="row"><?php echo e($k+$provide_dm_earning->firstItem()); ?></td>
                                    <td><?php if($at->delivery_man): ?><a href="<?php echo e(route('admin.delivery-man.preview', $at->delivery_man_id)); ?>"><?php echo e($at->delivery_man->f_name.' '.$at->delivery_man->l_name); ?></a> <?php else: ?> <label class="text-capitalize text-danger"><?php echo e(translate('messages.deliveryman_deleted')); ?></label> <?php endif; ?> </td>
                                    <td>
                                        <?php echo e(\App\CentralLogics\Helpers::time_date_format($at->created_at)); ?>

                                    </td>
                                    <td><?php echo e(\App\CentralLogics\Helpers::format_currency($at['amount'])); ?></td>
                                    <td><?php echo e($at['method']); ?></td>
                                    <?php if(  $at['ref'] == 'delivery_man_wallet_adjustment_full'): ?>
                                    <td><?php echo e(translate('wallet_adjusted')); ?></td>
                                <?php elseif( $at['ref'] == 'delivery_man_wallet_adjustment_partial'): ?>
                                    <td><?php echo e(translate('wallet_adjusted_partially')); ?></td>
                                <?php else: ?>
                                <td><?php echo e(translate($at['ref'])?? translate('N/A')); ?></td>

                                <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php if(count($provide_dm_earning) === 0): ?>
                        <div class="empty--data">
                            <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/empty.png')); ?>" alt="public">
                            <h5>
                                <?php echo e(translate('no_data_found')); ?>

                            </h5>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-footer">
                    <?php echo e($provide_dm_earning->links()); ?>

                </div>
            </div>
        </div>
     </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/js/view-pages/deliveryman-earning-provide.js"></script>
    <script>
        "use strict";
    $('#deliveryman').select2({
        ajax: {
            url: '<?php echo e(url('/')); ?>/admin/delivery-man/get-deliverymen',
            data: function (params) {
                return {
                    q: params.term, // search term
                    earning: true,
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

    function getAccountData(route, data_id, type)
    {
        $.get({
                url: route+data_id,
                dataType: 'json',
                success: function (data) {
                    $('#account_info').html('(<?php echo e(translate('messages.payable_amount')); ?>: '+data.payable_amount+')');
                },
            });
    }

    $('#add_transaction').on('submit', function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post({
            url: '<?php echo e(route('admin.provide-deliveryman-earnings.store')); ?>',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.errors) {
                    for (let i = 0; i < data.errors.length; i++) {
                        toastr.error(data.errors[i].message, {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }
                } else {
                    toastr.success('<?php echo e(translate('messages.transaction_saved')); ?>', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    setTimeout(function () {
                        location.href = '<?php echo e(route('admin.provide-deliveryman-earnings.index')); ?>';
                    }, 2000);
                }
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/deliveryman-earning-provide/index.blade.php ENDPATH**/ ?>