<?php $__env->startSection('title',translate('messages.customer_loyalty_point_report')); ?>

<?php $__env->startPush('css_or_js'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title text-capitalize">
                <div class="card-header-icon d-inline-flex mr-2 img">
                    <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/payment.png')); ?>" alt="public">
                </div>
                <span>
                    <?php echo e(translate('messages.customer_loyalty_point_report')); ?>

                </span>
            </h1>
        </div>
        <!-- End Page Header -->

        <div class="card mb-3">
            <div class="card-header text-capitalize">
                <h5 class="card-title">
                    <span class="card-header-icon">
                        <i class="tio-filter-outlined"></i>
                    </span>
                    <span><?php echo e(translate('messages.filter_options')); ?></span>
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 pt-3">
                        <form action="<?php echo e(route('admin.customer.loyalty-point.report')); ?>" method="get">
                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <input type="date" name="from" id="from_date" value="<?php echo e(request()->get('from')); ?>" class="form-control h--45px" title="<?php echo e(translate('messages.from_date')); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <input type="date" name="to" id="to_date" value="<?php echo e(request()->get('to')); ?>" class="form-control h--45px" title="<?php echo e(translate('messages.to_date')); ?>">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <?php
                                        $transaction_status=request()->get('transaction_type');
                                        ?>
                                        <select name="transaction_type" id="" class="form-control h--45px" title="<?php echo e(translate('messages.select_transaction_type')); ?>">
                                            <option value=""><?php echo e(translate('messages.all')); ?></option>
                                            <option value="point_to_wallet" <?php echo e(isset($transaction_status) && $transaction_status=='point_to_wallet'?'selected':''); ?>><?php echo e(translate('messages.point_to_wallet')); ?></option>
                                            <option value="order_place" <?php echo e(isset($transaction_status) && $transaction_status=='order_place'?'selected':''); ?>><?php echo e(translate('messages.order_place')); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-12">
                                    <div class="mb-3">
                                        <select id='customer' name="customer_id" data-placeholder="<?php echo e(translate('messages.select_customer')); ?>" class="js-data-example-ajax form-control h--45px" title="<?php echo e(translate('messages.select_customer')); ?>">
                                            <?php if(request()->get('customer_id') && $customer_info = \App\Models\User::find(request()->get('customer_id'))): ?>
                                                <option value="<?php echo e($customer_info->id); ?>" selected><?php echo e($customer_info->f_name.' '.$customer_info->l_name); ?>(<?php echo e($customer_info->phone); ?>)</option>
                                            <?php endif; ?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="btn--container justify-content-end">

                                <button type="reset" id="reset_btn" class="btn btn--reset"><?php echo e(translate('messages.reset')); ?></button>

                                <button type="submit" class="btn btn--primary"><i class="tio-filter-list mr-1"></i><?php echo e(translate('messages.filter')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div class="row g-3">
            <?php
                $credit = $data[0]->total_credit??0;
                $debit = $data[0]->total_debit??0;
                $balance = $credit - $debit;
            ?>
            <!--Debit earned-->
            <div class="col-sm-4">
                <div class="resturant-card dashboard--card bg--2">
                    <h4 class="title"><?php echo e(translate('messages.debit')); ?></h4>
                    <span class="subtitle">
                        <?php echo e($debit); ?>

                    </span>
                    <img class="resturant-icon" src="<?php echo e(dynamicAsset('/public/assets/admin/img/dashboard/3.png')); ?>" alt="dashboard">
                </div>
            </div>
            <!--Debit earned End-->
            <!--credit earned-->
            <div class="col-sm-4">
                <div class="resturant-card dashboard--card bg--3">
                    <h4 class="title"><?php echo e(translate('messages.credit')); ?></h4>
                    <span class="subtitle">
                        <?php echo e($credit); ?>

                    </span>
                    <img class="resturant-icon" src="<?php echo e(dynamicAsset('/public/assets/admin/img/dashboard/4.png')); ?>" alt="dashboard">
                </div>
            </div>
            <!--credit earned end-->
            <!--balance earned-->
            <div class="col-sm-4">
                <div class="resturant-card dashboard--card bg--1">
                    <h4 class="title"><?php echo e(translate('messages.balance')); ?></h4>
                    <span class="subtitle">
                        <?php echo e($balance); ?>

                    </span>
                    <img class="resturant-icon" src="<?php echo e(dynamicAsset('/public/assets/admin/img/dashboard/1.png')); ?>" alt="dashboard">
                </div>
            </div>
            <!--balance earned end-->
        </div>
        <!-- End Stats -->
        <!-- Card -->
        <div class="card mt-3">
            <!-- Header -->
            <div class="card-header text-capitalize border-0">
                <h4 class="card-title">
                    <span class="card-header-icon"><i class="tio-money"></i></span>
                    <span><?php echo e(translate('messages.transactions')); ?></span>
                </h4>
                <form class="my-2 ml-auto mr-sm-2 mr-xl-4 ml-sm-auto flex-grow-1 flex-grow-sm-0">

                    <div class="input--group input-group input-group-merge input-group-flush">
                        <input id="datatableSearch_" type="search" name="search" class="form-control"
                              value="<?php echo e(request()?->search  ?? null); ?>"  placeholder="<?php echo e(translate('Ex:_Search_by_TransactionId_or_Reference')); ?>" aria-label="<?php echo e(translate('messages.search')); ?>" required>
                        <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>

                    </div>
                    <!-- End Search -->
                </form>
                    <!-- Unfold -->
                    <div class="hs-unfold mr-2">
                        <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle min-height-40" href="javascript;"
                            data-hs-unfold-options='{
                                    "target": "#usersExportDropdown",
                                    "type": "css-animation"
                                }'>
                            <i class="tio-download-to mr-1"></i> <?php echo e(translate('messages.export')); ?>

                        </a>

                        <div id="usersExportDropdown"
                            class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">
                            <span class="dropdown-header"><?php echo e(translate('messages.download_options')); ?></span>
                            <a id="export-excel" class="dropdown-item" href="<?php echo e(route('admin.customer.loyalty-point.export', ['type'=>'excel',request()->getQueryString()])); ?>">
                                <img class="avatar avatar-xss avatar-4by3 mr-2"
                                    src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/svg/components/excel.svg"
                                    alt="Image Description">
                                <?php echo e(translate('messages.excel')); ?>

                            </a>
                            <a id="export-csv" class="dropdown-item" href="<?php echo e(route('admin.customer.loyalty-point.export', ['type'=>'csv',request()->getQueryString()])); ?>">
                                <img class="avatar avatar-xss avatar-4by3 mr-2"
                                    src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/svg/components/placeholder-csv-format.svg"
                                    alt="Image Description">
                                .<?php echo e(translate('messages.csv')); ?>

                            </a>
                        </div>
                    </div>
                    <!-- End Unfold -->
            </div>
            <!-- End Header -->

            <!-- Body -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="datatable"
                        class="table table-thead-bordered table-align-middle card-table table-nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th><?php echo e(translate('messages.sl')); ?></th>
                                <th><?php echo e(translate('messages.transaction_id')); ?></th>
                                <th><?php echo e(translate('messages.Customer')); ?></th>
                                <th><?php echo e(translate('messages.credit')); ?></th>
                                <th><?php echo e(translate('messages.debit')); ?></th>
                                <th><?php echo e(translate('messages.balance')); ?></th>
                                <th><?php echo e(translate('messages.transaction_type')); ?></th>
                                <th><?php echo e(translate('messages.reference')); ?></th>
                                <th><?php echo e(translate('messages.created_at')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$wt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td ><?php echo e($k+$transactions->firstItem()); ?></td>
                                <td><?php echo e($wt->transaction_id); ?></td>
                                <td><a href="<?php echo e(route('admin.customer.view',['user_id'=>$wt->user_id])); ?>"><?php echo e(Str::limit($wt->user?$wt->user->f_name.' '.$wt->user->l_name:translate('messages.not_found'),20,'...')); ?></a></td>
                                <td><?php echo e($wt->credit); ?></td>
                                <td><?php echo e($wt->debit); ?></td>
                                <td><?php echo e($wt->balance); ?></td>
                                <td>
                                    <span class="badge badge-soft-<?php echo e($wt->transaction_type=='point_to_wallet'?'success':'dark'); ?>">
                                        <?php echo e(translate('messages.'.$wt->transaction_type)); ?>

                                    </span>
                                </td>
                                <td><?php echo e($wt->reference); ?></td>

                                <td><?php echo e(\App\CentralLogics\Helpers::time_date_format($wt->created_at)); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <?php if(!$transactions): ?>
                    <div class="empty--data">
                        <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/empty.png')); ?>" alt="public">
                        <h5>
                            <?php echo e(translate('no_data_found')); ?>

                        </h5>
                    </div>
                    <?php endif; ?>
                </div>
                <!-- Pagination -->
                <div class="page-area px-4 pb-3">
                    <div class="d-flex align-items-center justify-content-end">
                        <div>
                            <?php echo $transactions->links(); ?>

                        </div>
                    </div>
                </div>
                <!-- Pagination -->
            </div>
            <!-- End Body -->

        </div>
        <!-- End Card -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startPush('script_2'); ?>

    <script src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/vendor/chart.js/dist/Chart.min.js"></script>
    <script
        src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/vendor/chartjs-chart-matrix/dist/chartjs-chart-matrix.min.js"></script>
    <script src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/js/hs.chartjs-matrix.js"></script>
    <script src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/js/view-pages/customer-loyalty-report.js"></script>
    <script>
        "use strict";
        $(document).on('ready', function () {
            $('.js-data-example-ajax').select2({
                ajax: {
                    url: '<?php echo e(route('admin.customer.select-list')); ?>',
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            all: true,
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
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/admin-views/customer/loyalty-point/report.blade.php ENDPATH**/ ?>