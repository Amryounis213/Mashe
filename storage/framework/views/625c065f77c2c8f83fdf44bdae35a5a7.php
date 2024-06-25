<?php $__env->startSection('title', translate('messages.order_report')); ?>

<?php $__env->startPush('css_or_js'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-header-title">
                <span class="page-header-icon">
                    <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/report/new/order_report.png')); ?>" class="w--22" alt="">
                </span>
                <span>
                    <?php echo e(translate('messages.order_report')); ?>

                </span>
            </h1>
        </div>
        <!-- End Page Header -->

        <div class="card mb-20">
            <div class="card-body">
                <h4 class=""><?php echo e(translate('Search_Data')); ?></h4>
                <form  method="get">

                    <div class="row g-3">
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
                                value=<?php echo e(isset($from) ? $from  : ''); ?> required>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <input type="date" name="to" id="to_date" class="form-control"
                                placeholder="<?php echo e(translate('End_Date')); ?>"
                                value=<?php echo e(isset($to) ? $to  : ''); ?> required>
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

        <div class="mb-20">
            <div class="row g-2">
                <div class="col-sm-6 col-lg-4">
                    <a class="order--card h-100" href="#">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="card-subtitle d-flex justify-content-between m-0 align-items-center">
                                <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/order-icons/schedule.png')); ?>" alt="dashboard" class="oder--card-icon">
                                <span><?php echo e(translate('Scheduled_Orders')); ?></span>
                            </h6>
                            <span class="card-title" style="--base-clr:#0661CB">
                                <?php echo e($total_scheduled_count); ?>

                            </span>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <a class="order--card h-100" href="#">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="card-subtitle d-flex justify-content-between m-0 align-items-center">
                                <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/order-icons/pending.png')); ?>" alt="dashboard" class="oder--card-icon">
                                <span><?php echo e(translate('Pending_Orders')); ?></span>
                            </h6>
                            <span class="card-title" style="--base-clr:#0661CB">
                                <?php echo e($total_pending_count); ?>

                            </span>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <a class="order--card h-100" href="#">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="card-subtitle d-flex justify-content-between m-0 align-items-center">
                                <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/order-icons/accepted.png')); ?>" alt="dashboard" class="oder--card-icon">
                                <span><?php echo e(translate('Accepted_Orders')); ?></span>
                            </h6>
                            <span class="card-title" style="--base-clr:#0661CB">
                                <?php echo e($total_accepted_count); ?>

                            </span>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <a class="order--card h-100" href="#">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="card-subtitle d-flex justify-content-between m-0 align-items-center">
                                <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/order-icons/processing.png')); ?>" alt="dashboard" class="oder--card-icon">
                                <span><?php echo e(translate('Processing_Orders')); ?></span>
                            </h6>
                            <span class="card-title" style="--base-clr:#00AA6D">
                                <?php echo e($total_progress_count); ?>

                            </span>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <a class="order--card h-100" href="#">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="card-subtitle d-flex justify-content-between m-0 align-items-center">
                                <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/order-icons/on-the-way.png')); ?>" alt="dashboard" class="oder--card-icon">
                                <span><?php echo e(translate('Food_On_the_Way')); ?></span>
                            </h6>
                            <span class="card-title" style="--base-clr:#00AA6D">
                                <?php echo e($total_on_the_way_count); ?>

                            </span>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <a class="order--card h-100" href="#">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="card-subtitle d-flex justify-content-between m-0 align-items-center">
                                <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/order-icons/delivered.png')); ?>" alt="dashboard" class="oder--card-icon">
                                <span><?php echo e(translate('Delivered')); ?></span>
                            </h6>
                            <span class="card-title" style="--base-clr:#00AA6D">
                                <?php echo e($total_delivered_count); ?>

                            </span>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <a class="order--card h-100" href="#">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="card-subtitle d-flex justify-content-between m-0 align-items-center">
                                <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/order-icons/canceled.png')); ?>" alt="dashboard" class="oder--card-icon">
                                <span><?php echo e(translate('Canceled')); ?></span>
                            </h6>
                            <span class="card-title" style="--base-clr:#FF7500">
                                <?php echo e($total_canceled_count); ?>

                            </span>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <a class="order--card h-100" href="#">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="card-subtitle d-flex justify-content-between m-0 align-items-center">
                                <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/order-icons/failed.png')); ?>" alt="dashboard" class="oder--card-icon">
                                <span><?php echo e(translate('Payment_Failed')); ?></span>
                            </h6>
                            <span class="card-title" style="--base-clr:#FF7500">
                                <?php echo e($total_failed_count); ?>

                            </span>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <a class="order--card h-100" href="#">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="card-subtitle d-flex justify-content-between m-0 align-items-center">
                                <img src="<?php echo e(dynamicAsset('/public/assets/admin/img/order-icons/refunded.png')); ?>" alt="dashboard" class="oder--card-icon">
                                <span><?php echo e(translate('Refunded')); ?></span>
                            </h6>
                            <span class="card-title" style="--base-clr:#FF7500">
                                <?php echo e($total_refunded_count); ?>

                            </span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- End Stats -->
        <!-- Card -->
        <div class="card mt-3">
            <!-- Header -->
            <div class="card-header border-0 py-2">
                <div class="search--button-wrapper">
                    <h3 class="card-title">
                        <?php echo e(translate('messages.Total_Orders')); ?> <span
                            class="badge badge-soft-secondary" id="countItems"><?php echo e($orders->total()); ?></span>
                    </h3>
                    <form  class="search-form">
                        <!-- Search -->
                        <div class="input--group input-group input-group-merge input-group-flush">
                            <input name="search" type="search" class="form-control"  value="<?php echo e(request()->search ?? null); ?>"  placeholder="<?php echo e(translate('Search_by_Order_ID')); ?>">
                            <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>
                        </div>
                        <!-- End Search -->
                    </form>
                    <!-- Static Export Button -->
                    <div class="hs-unfold ml-3">
                        <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle btn export-btn font--sm"
                            href="javascript:;"
                            data-hs-unfold-options="{
                                &quot;target&quot;: &quot;#usersExportDropdown&quot;,
                                &quot;type&quot;: &quot;css-animation&quot;
                            }"
                            data-hs-unfold-target="#usersExportDropdown" data-hs-unfold-invoker="">
                            <i class="tio-download-to mr-1"></i> <?php echo e(translate('export')); ?>

                        </a>

                        <div id="usersExportDropdown"
                            class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right hs-unfold-content-initialized hs-unfold-css-animation animated hs-unfold-reverse-y hs-unfold-hidden">

                            <span class="dropdown-header"><?php echo e(translate('download_options')); ?></span>
                            <a id="export-excel" class="dropdown-item"
                                href="<?php echo e(route('vendor.report.order-report-export', ['type' => 'excel', request()->getQueryString()])); ?>">
                                <img class="avatar avatar-xss avatar-4by3 mr-2"
                                    src="<?php echo e(dynamicAsset('public/assets/admin/svg/components/excel.svg')); ?>"
                                    alt="Image Description">
                                <?php echo e(translate('messages.excel')); ?>

                            </a>
                            <a id="export-csv" class="dropdown-item"
                                href="<?php echo e(route('vendor.report.order-report-export', ['type' => 'csv', request()->getQueryString()])); ?>">
                                <img class="avatar avatar-xss avatar-4by3 mr-2"
                                    src="<?php echo e(dynamicAsset('public/assets/admin/svg/components/placeholder-csv-format.svg')); ?>"
                                    alt="Image Description">
                                <?php echo e(translate('messages.csv')); ?>

                            </a>

                        </div>
                    </div>
                    <!-- Static Export Button -->
                </div>
            </div>
            <!-- End Header -->

            <!-- Body -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-borderless middle-align __txt-14px">
                        <thead class="thead-light white--space-false">
                            <tr>
                                <th class="border-top border-bottom word-nobreak"><?php echo e(translate('messages.sl')); ?></th>
                                <th class="border-top border-bottom word-nobreak"><?php echo e(translate('messages.order_id')); ?></th>
                                <th class="border-top border-bottom word-nobreak"><?php echo e(translate('messages.restaurant')); ?></th>
                                <th class="border-top border-bottom word-nobreak"><?php echo e(translate('messages.customer_name')); ?></th>
                                <th class="border-top border-bottom word-nobreak"><?php echo e(translate('messages.total_item_amount')); ?></th>
                                <th class="border-top border-bottom word-nobreak"><?php echo e(translate('messages.item_discount')); ?></th>
                                <th class="border-top border-bottom word-nobreak"><?php echo e(translate('messages.coupon_discount')); ?></th>
                                <th class="border-top border-bottom word-nobreak"><?php echo e(translate('messages.referral_discount')); ?></th>
                                <th class="border-top border-bottom word-nobreak"><?php echo e(translate('messages.discounted_amount')); ?></th>
                                <th class="border-top border-bottom text-center"><?php echo e(translate('messages.tax')); ?></th>
                                <th class="border-top border-bottom word-nobreak"><?php echo e(translate('messages.delivery_charge')); ?></th>
                                <th class="border-top border-bottom text-center"><?php echo e(\App\CentralLogics\Helpers::get_business_data('additional_charge_name')??translate('messages.additional_charge')); ?></th>
                                <th class="border-top border-bottom word-nobreak"><?php echo e(translate('messages.extra_packaging_amount')); ?></th>
                                <th class="border-top border-bottom word-nobreak text-right"><?php echo e(translate('messages.order_amount')); ?></th>
                                <th class="border-top border-bottom word-nobreak"><?php echo e(translate('messages.amount_received_by')); ?></th>
                                <th class="border-top border-bottom word-nobreak"><?php echo e(translate('messages.payment_method')); ?></th>
                                <th class="border-top border-bottom word-nobreak"><?php echo e(translate('messages.order_status')); ?></th>
                                <th class="border-top border-bottom text-center"><?php echo e(translate('messages.action')); ?>

                                </th>
                            </tr>
                        </thead>
                        <tbody id="set-rows">
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="status-<?php echo e($order['order_status']); ?> class-all">
                                    <td class="">
                                        <?php echo e($key + $orders->firstItem()); ?>

                                    </td>
                                    <td class="table-column-pl-0">
                                        <a
                                            href="<?php echo e(route('vendor.order.details', ['id' => $order['id']])); ?>"><?php echo e($order['id']); ?></a>
                                    </td>
                                    <td  class="text-capitalize">
                                        <?php if($order->restaurant): ?>
                                            <?php echo e(Str::limit($order->restaurant->name,25,'...')); ?>

                                        <?php else: ?>
                                            <label class="badge badge-danger"><?php echo e(translate('messages.invalid')); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($order->customer): ?>
                                            <a class="text-body text-capitalize"
                                                href="#">
                                                <strong><?php echo e($order->customer['f_name'] . ' ' . $order->customer['l_name']); ?></strong>
                                            </a>
                                        <?php elseif($order->is_guest): ?>
                                             <?php
                                        $customer_details = json_decode($order['delivery_address'],true);
                                    ?>
                                            <strong><?php echo e($customer_details['contact_person_name']); ?></strong>
                                            <div><?php echo e($customer_details['contact_person_number']); ?></div>
                                        <?php else: ?>
                                            <label class="badge badge-danger"><?php echo e(translate('messages.invalid_customer_data')); ?></label>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="text-right mw--85px">
                                            <div>
                                                <?php echo e(\App\CentralLogics\Helpers::number_format_short($order['order_amount']- $order['additional_charge'] - $order['dm_tips']-$order['total_tax_amount'] - $order['extra_packaging_amount']  -$order['delivery_charge']+$order['coupon_discount_amount'] + $order['restaurant_discount_amount'] + $order['ref_bonus_amount'])); ?>

                                            </div>
                                            <?php if($order->payment_status == 'paid'): ?>
                                                <strong class="text-success">
                                                    <?php echo e(translate('messages.paid')); ?>

                                                </strong>
                                            <?php else: ?>
                                                <strong class="text-danger">
                                                    <?php echo e(translate('messages.unpaid')); ?>

                                                </strong>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td class="text-center mw--85px">
                                        <?php echo e(\App\CentralLogics\Helpers::number_format_short($order->details()->sum(DB::raw('discount_on_food * quantity')))); ?>

                                    </td>
                                    <td class="text-center mw--85px">
                                        <?php echo e(\App\CentralLogics\Helpers::number_format_short($order['coupon_discount_amount'])); ?>

                                    </td>
                                    <td class="text-center mw--85px">
                                        <?php echo e(\App\CentralLogics\Helpers::number_format_short($order['ref_bonus_amount'])); ?>

                                    </td>
                                    <td class="text-center mw--85px">
                                        <?php echo e(\App\CentralLogics\Helpers::number_format_short($order['coupon_discount_amount'] + $order['restaurant_discount_amount'] + $order['ref_bonus_amount'])); ?>

                                    </td>
                                    <td class="text-center mw--85px white-space-nowrap">
                                        <?php echo e(\App\CentralLogics\Helpers::number_format_short($order['total_tax_amount'])); ?>

                                    </td>
                                    <td class="text-center mw--85px">
                                        <?php echo e(\App\CentralLogics\Helpers::number_format_short($order['delivery_charge'])); ?>

                                    </td>
                                    <td class="text-center mw--85px">
                                        <?php echo e(\App\CentralLogics\Helpers::number_format_short($order['additional_charge'])); ?>

                                    </td>
                                    <td class="text-center mw--85px">
                                        <?php echo e(\App\CentralLogics\Helpers::number_format_short($order['extra_packaging_amount'])); ?>

                                    </td>
                                    <td>
                                        <div class="text-right mw--85px">
                                            <div>
                                                <?php echo e(\App\CentralLogics\Helpers::number_format_short($order['order_amount'])); ?>

                                            </div>
                                            <?php if($order->payment_status == 'paid'): ?>
                                                <strong class="text-success">
                                                    <?php echo e(translate('messages.paid')); ?>

                                                </strong>
                                            <?php else: ?>
                                                <strong class="text-danger">
                                                    <?php echo e(translate('messages.unpaid')); ?>

                                                </strong>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td class="text-center mw--85px text-capitalize">
                                        <?php echo e(isset($order->transaction) ? translate(str_replace('_', ' ', $order->transaction->received_by))  : translate('messages.not_received_yet')); ?>

                                    </td>
                                    <td class="text-center mw--85px text-capitalize">
                                            <?php echo e(translate(str_replace('_', ' ', $order['payment_method']))); ?>

                                    </td>
                                    <td class="text-center mw--85px text-capitalize">
                                        <?php if($order['order_status']=='pending'): ?>
                                                <span class="badge badge-soft-info">
                                                  <?php echo e(translate('messages.pending')); ?>

                                                </span>
                                            <?php elseif($order['order_status']=='confirmed'): ?>
                                                <span class="badge badge-soft-info">
                                                  <?php echo e(translate('messages.confirmed')); ?>

                                                </span>
                                            <?php elseif($order['order_status']=='processing'): ?>
                                                <span class="badge badge-soft-warning">
                                                  <?php echo e(translate('messages.processing')); ?>

                                                </span>
                                            <?php elseif($order['order_status']=='picked_up'): ?>
                                                <span class="badge badge-soft-warning">
                                                  <?php echo e(translate('messages.out_for_delivery')); ?>

                                                </span>
                                            <?php elseif($order['order_status']=='delivered'): ?>
                                                <span class="badge badge-soft-success">
                                                  <?php echo e(translate('messages.delivered')); ?>

                                                </span>
                                            <?php elseif($order['order_status']=='failed'): ?>
                                                <span class="badge badge-soft-danger">
                                                  <?php echo e(translate('messages.payment_failed')); ?>

                                                </span>
                                            <?php elseif($order['order_status']=='handover'): ?>
                                                <span class="badge badge-soft-danger">
                                                  <?php echo e(translate('messages.handover')); ?>

                                                </span>
                                            <?php elseif($order['order_status']=='canceled'): ?>
                                                <span class="badge badge-soft-danger">
                                                  <?php echo e(translate('messages.canceled')); ?>

                                                </span>
                                            <?php elseif($order['order_status']=='accepted'): ?>
                                                <span class="badge badge-soft-danger">
                                                  <?php echo e(translate('messages.accepted')); ?>

                                                </span>
                                            <?php else: ?>
                                                <span class="badge badge-soft-danger">
                                                  <?php echo e(translate(str_replace('_',' ',$order['order_status']))); ?>

                                                </span>
                                            <?php endif; ?>

                                    </td>


                                    <td>
                                        <div class="btn--container justify-content-center">
                                            <a class="ml-2 btn btn-sm btn--warning btn-outline-warning action-btn"
                                                href="<?php echo e(route('vendor.order.details', ['id' => $order['id']])); ?>">
                                                <i class="tio-invisible"></i>
                                            </a>
                                            <a class="ml-2 btn btn-sm btn--primary btn-outline-primary action-btn"
                                                href="<?php echo e(route('vendor.order.generate-invoice', ['id' => $order['id']])); ?>">
                                                <i class="tio-print"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <!-- End Table -->


            </div>
            <!-- End Body -->
            <?php if(count($orders) !== 0): ?>
                <hr>
            <?php endif; ?>
            <div class="page-area px-4 pb-3">
                <?php echo $orders->links(); ?>

            </div>
            <?php if(count($orders) === 0): ?>
                <div class="empty--data">
                    <img src="<?php echo e(dynamicAsset('/public/assets/admin/svg/illustrations/sorry.svg')); ?>" alt="public">
                    <h5>
                        <?php echo e(translate('no_data_found')); ?>

                    </h5>
                </div>
            <?php endif; ?>
        </div>
        <!-- End Card -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script_2'); ?>
    <script src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/vendor/chartjs-chart-matrix/dist/chartjs-chart-matrix.min.js">
    </script>
    <script src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/js/hs.chartjs-matrix.js"></script>
    <script src="<?php echo e(dynamicAsset('public/assets/admin')); ?>/js/view-pages/vendor/report.js"></script>

    <script>
        $(document).on('ready', function() {



            $('.js-data-example-ajax-2').select2({
                ajax: {
                    url: '<?php echo e(url('/')); ?>/admin/customer/select-list',
                    data: function(params) {
                        return {
                            q: params.term, // search term
                            all:true,
                            <?php if(isset($zone)): ?>
                                zone_ids: [<?php echo e($zone->id); ?>],
                            <?php endif; ?>
                            <?php if(request('restaurant_id')): ?>
                                restaurant_id: <?php echo e(request('restaurant_id')); ?>,
                            <?php endif; ?>
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
        });
    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.vendor.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\Mashe-Backend-main\resources\views/vendor-views/report/order-report.blade.php ENDPATH**/ ?>