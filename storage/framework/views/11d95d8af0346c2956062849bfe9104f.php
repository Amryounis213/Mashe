<?php $__env->startSection('title', translate('messages.Disbursement_Report')); ?>

<?php $__env->startPush('css_or_js'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <div class="page-header">
            <h1 class="page-header-title">
            <span class="page-header-icon">
                <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/report/new/disburstment.png')); ?>" class="w--22" alt="">
            </span>
                <span><?php echo e(translate('Disbursement_Report')); ?></span>
            </h1>
        </div>
        <!-- Reports -->
        <div class="disbursement-report mb-20">
            <div class="__card-3 rebursement-item">
                <img src="<?php echo e(dynamicAsset('public/assets/admin/img/report/new/trx1.png')); ?>" class="icon" alt="report/new">
                <h3 class="title text-008958"><?php echo e(\App\CentralLogics\Helpers::format_currency($pending)); ?>

                </h3>
                <h6 class="subtitle"><?php echo e(translate('Pending_Disbursements')); ?></h6>
                <div class="info-icon" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo e(translate('All_the_pending_disbursement_requests_that_require_admin’s_action_(complete/cancel).')); ?>">
                    <img src="<?php echo e(dynamicAsset('public/assets/admin/img/report/new/info1.png')); ?>" alt="report/new">
                </div>
            </div>

            <div class="__card-3 rebursement-item">
                <img src="<?php echo e(dynamicAsset('public/assets/admin/img/report/new/trx5.png')); ?>" class="icon" alt="report/new">
                <h3 class="title text-FF7E0D"><?php echo e(\App\CentralLogics\Helpers::format_currency($completed)); ?>

                </h3>
                <h6 class="subtitle"><?php echo e(translate('Completed_Disbursements')); ?></h6>
                <div class="info-icon" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo e(translate('The_amount_of_disbursement_is_completed.')); ?>">
                    <img src="<?php echo e(dynamicAsset('public/assets/admin/img/report/new/info5.png')); ?>" alt="report/new">
                </div>
            </div>

            <div class="__card-3 rebursement-item">
                <img src="<?php echo e(dynamicAsset('public/assets/admin/img/report/new/trx3.png')); ?>" class="icon" alt="report/new">
                <h3 class="title text-FF5A54"><?php echo e(\App\CentralLogics\Helpers::format_currency($canceled)); ?>

                </h3>
                <h6 class="subtitle"><?php echo e(translate('Cancele_ Transactions')); ?></h6>
                <div class="info-icon" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo e(translate('See_all_the_canceled_disbursement_amounts_here.')); ?>">
                    <img src="<?php echo e(dynamicAsset('public/assets/admin/img/report/new/info3.png')); ?>" alt="report/new">
                </div>
            </div>
        </div>

        <div class="card mb-20">
            <div class="card-body">
                <h4 class=""><?php echo e(translate('Search_Data')); ?></h4>
                <form method="get">
                    <div class="row g-3">
                        <div class="col-sm-6 col-md-3">
                            <select name="payment_method_id" data-url="<?php echo e(url()->full()); ?>" data-filter="payment_method_id"
                                    data-placeholder="<?php echo e(translate('messages.select_payment_method')); ?>"
                                    class="form-control js-select2-custom set-filter">
                                <option value="all"><?php echo e(translate('All_Payment_Method')); ?></option>
                                <?php $__currentLoopData = $withdrawal_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item['id']); ?>" <?php echo e(isset($payment_method_id) && $payment_method_id == $item['id'] ? 'selected' : ''); ?>><?php echo e($item['method_name']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <select name="status" data-url="<?php echo e(url()->full()); ?>" data-filter="status"
                                    data-placeholder="<?php echo e(translate('messages.select_status')); ?>"
                                    class="form-control js-select2-custom set-filter">
                                <option value="all" <?php echo e(isset($status) && $status == 'all' ? 'selected' : ''); ?>><?php echo e(translate('All_status')); ?></option>
                                <option value="pending" <?php echo e(isset($status) && $status == 'pending' ? 'selected' : ''); ?>><?php echo e(translate('pending')); ?></option>
                                <option value="completed" <?php echo e(isset($status) && $status == 'completed' ? 'selected' : ''); ?>><?php echo e(translate('completed')); ?></option>
                                <option value="canceled" <?php echo e(isset($status) && $status == 'canceled' ? 'selected' : ''); ?>><?php echo e(translate('canceled')); ?></option>
                            </select>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <select class="form-control set-filter" name="filter"
                                    data-url="<?php echo e(url()->full()); ?>" data-filter="filter">
                                <option value="all_time" <?php echo e(isset($filter) && $filter == 'all_time' ? 'selected' : ''); ?>>
                                    <?php echo e(translate('messages.All_Time')); ?></option>
                                <option value="this_year" <?php echo e(isset($filter) && $filter == 'this_year' ? 'selected' : ''); ?>>
                                    <?php echo e(translate('messages.This_Year')); ?></option>
                                <option value="previous_year"
                                    <?php echo e(isset($filter) && $filter == 'previous_year' ? 'selected' : ''); ?>>
                                    <?php echo e(translate('messages.Previous_Year')); ?></option>
                                <option value="this_month"
                                    <?php echo e(isset($filter) && $filter == 'this_month' ? 'selected' : ''); ?>>
                                    <?php echo e(translate('messages.This_Month')); ?></option>
                                <option value="this_week" <?php echo e(isset($filter) && $filter == 'this_week' ? 'selected' : ''); ?>>
                                    <?php echo e(translate('messages.This_Week')); ?></option>
                                <option value="custom" <?php echo e(isset($filter) && $filter == 'custom' ? 'selected' : ''); ?>>
                                    <?php echo e(translate('messages.Custom')); ?></option>
                            </select>
                        </div>
                        <?php if(isset($filter) && $filter == 'custom'): ?>
                            <div class="col-sm-6 col-md-3">
                                <input type="date" name="from" id="from_date" class="form-control"
                                       placeholder="<?php echo e(translate('Start_Date')); ?>"
                                       value=<?php echo e($from ? $from  : ''); ?> required>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <input type="date" name="to" id="to_date" class="form-control"
                                       placeholder="<?php echo e(translate('End_Date')); ?>"
                                       value=<?php echo e($to ? $to  : ''); ?>  required>
                            </div>
                        <?php endif; ?>
                        <div class="col-sm-6 col-md-3 ml-auto">
                            <button type="submit"
                                    class="btn btn-primary btn-block"><?php echo e(translate('Filter')); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card-header border-0 py-2">
            <div class="search--button-wrapper">
                <h2 class="card-title">
                    <?php echo e(translate('Total_Disbursements')); ?> <span class="badge badge-soft-secondary ml-2" id="countItems"><?php echo e($disbursements->total()); ?></span>
                </h2>
                <form class="search-form">
                    <!-- Search -->
                    <div class="input--group input-group input-group-merge input-group-flush">
                        <input class="form-control" value="<?php echo e(request()?->search  ?? null); ?>" placeholder="<?php echo e(translate('search_by_id')); ?>" name="search">
                        <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>
                    </div>
                    <!-- End Search -->
                </form>
                <!-- Static Export Button -->
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
                        <a id="export-excel" class="dropdown-item" href="<?php echo e(route('vendor.report.disbursement-report-export', ['type'=>'excel',request()->getQueryString()])); ?>">
                            <img class="avatar avatar-xss avatar-4by3 mr-2" src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/svg/components/excel.svg" alt="Image Description">
                            <?php echo e(translate('messages.excel')); ?>

                        </a>
                        <a id="export-csv" class="dropdown-item" href="<?php echo e(route('vendor.report.disbursement-report-export', ['type'=>'excel',request()->getQueryString()])); ?>">
                            <img class="avatar avatar-xss avatar-4by3 mr-2" src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/svg/components/placeholder-csv-format.svg" alt="Image Description">
                            <?php echo e(translate('messages.csv')); ?>

                        </a>
                    </div>
                </div>
                <!-- Static Export Button -->
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-thead-bordered table-align-middle card-table">
                    <thead>
                    <tr>
                        <th><?php echo e(translate('sl')); ?></th>
                        <th><?php echo e(translate('id')); ?></th>
                        <th><?php echo e(translate('created_at')); ?></th>
                        <th><?php echo e(translate('Disburse_Amount')); ?></th>
                        <th><?php echo e(translate('Payment_method')); ?></th>
                        <th><?php echo e(translate('status')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $disbursements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $disbursement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <span class="font-weight-bold"><?php echo e($key+1); ?></span>
                            </td>
                            <td>
                                #<?php echo e($disbursement->disbursement_id); ?>

                            </td>
                            <td>
                                <?php echo e(\App\CentralLogics\Helpers::time_date_format($disbursement->created_at)); ?>

                            </td>
                            <td>
                                <?php echo e(\App\CentralLogics\Helpers::format_currency($disbursement['disbursement_amount'])); ?>

                            </td>
                            <td>
                                <div>
                                    <?php echo e($disbursement?->withdraw_method?->method_name ?? translate('Default_method')); ?>

                                </div>
                            </td>
                            <td>
                                <?php if($disbursement->status=='pending'): ?>
                                    <label class="badge badge-soft-primary"><?php echo e(translate('pending')); ?></label>
                                <?php elseif($disbursement->status=='completed'): ?>
                                    <label class="badge badge-soft-success"><?php echo e(translate('Completed')); ?></label>
                                <?php else: ?>
                                    <label class="badge badge-soft-danger"><?php echo e(translate('canceled')); ?></label>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php if(count($disbursements) === 0): ?>
                    <div class="empty--data">
                        <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/empty.png')); ?>" alt="public">
                        <h5>
                            <?php echo e(translate('no_data_found')); ?>

                        </h5>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="page-area px-4 pb-3">
            <div class="d-flex align-items-center justify-content-end">
                <div>
                    <?php echo $disbursements->links(); ?>

                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/js/view-pages/vendor/report.js"></script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.vendor.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/vendor-views/report/disbursement-report.blade.php ENDPATH**/ ?>